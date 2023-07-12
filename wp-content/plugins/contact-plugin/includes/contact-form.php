<?php

add_shortcode('contact', 'show_contact_form');
add_action('rest_api_init', 'create_rest_endpoint');
add_action( 'init', 'create_submissions_page' );
add_action( 'add_meta_boxes', 'create_meta_boxes' );
add_filter( 'manage_submission_posts_columns', 'custom_submission_columns' );
add_action( 'manage_submission_posts_custom_column', 'fill_submission_columns', 10, 2 );
add_action('admin_init', 'setup_search');

function setup_search() {
    global $typenow;
    if ($typenow === 'submission') {
        add_filter( 'posts_search', 'submission_search_override', 10, 2 );
    }
}

function submission_search_override($search, $query) {
      // Override the submissions page search to include custom meta data

      global $wpdb;

      if ($query->is_main_query() && !empty($query->query['s'])) {
            $sql    = "
              or exists (
                  select * from {$wpdb->postmeta} where post_id={$wpdb->posts}.ID
                  and meta_key in ('name','email','phone')
                  and meta_value like %s
              )
          ";
            $like   = '%' . $wpdb->esc_like($query->query['s']) . '%';
            $search = preg_replace(
                  "#\({$wpdb->posts}.post_title LIKE [^)]+\)\K#",
                  $wpdb->prepare($sql, $like),
                  $search
            );
      }

      return $search;
}

function fill_submission_columns($column, $post_id) {
    switch ($column) {
        case 'name':
            echo get_post_meta( $post_id, 'name', true );
            break;
        case 'email':
            echo get_post_meta( $post_id, 'email', true );
            break;
        case 'phone':
            echo get_post_meta( $post_id, 'phone', true );
            break;
        case 'message':
            echo get_post_meta( $post_id, 'message', true );
            break;
        default:
            break;
    }
}


function custom_submission_columns($columns) {
    $columns = array(
        'cb' => $columns['cb'],
        'title' => __( 'Title', 'contact-plugin' ),
        'name' => __( 'Name', 'contact-plugin' ),
        'email' => __( 'Email', 'contact-plugin' ),
        'phone' => __( 'Phone', 'contact-plugin' ),
        'message' => __( 'Message', 'contact-plugin' ),
    );

    return $columns;
}


function create_meta_boxes() {
    add_meta_box('custom_contact_form', 'Submissions', 'display_submission', 'submission');
}

function display_submission() {
    $postmetas = get_post_meta(get_the_ID());
    unset($postmetas['_edit_lock']);
    unset($postmetas['_wp_http_referer']);
    unset($postmetas['_edit_last']);
    foreach($postmetas as $key => $values) {
        echo $key . ': ';
        foreach($values as $value) {
            echo $value . '<br>';
        }
    }
}


function create_submissions_page() {
    $args = [
        'public' => true,
        'has_archive' => true,
        'labels' => [
            'name' => 'Submissions',
            'singular' => 'Submission'
        ],
        'supports' => false
    ];

    register_post_type('submission', $args);
}

function show_contact_form() {
    include MY_PLUGIN_PATH . 'includes/templates/contact-form.php';
}

function create_rest_endpoint() {
    register_rest_route('v1/contact-form', 'submit', array(
        'methods' => 'POST',
        'callback' => 'handle_enquiry'
    ));
}

function handle_enquiry($data) {
    $params = $data->get_params();
    if (!wp_verify_nonce($params['_wpnonce'], 'wp_rest')) {
        return new WP_Rest_Response('Message not sent', 422);
    }
    unset($params['_wpnonce']);
    unset($params['_wp_http_referrer']);

    // Send email message
    $headers = [];
    $admin_email = get_bloginfo( 'admin_email' );
    $admin_name = get_bloginfo( 'name' );
    $headers[] = "From: {$admin_name} {$admin_email}";
    $headers[] = "Reply-to: {$params['name']} <{$params['email']}>";
    $subject = "New enquiry from {$params['name']}";
    $message = '';
    $message .= "<h1>Message has sent from {$params['name']}</h1> <br> <br>";

    $postarr = [
        'post_title' => $params['name'],
        'post_type' => 'submission',
        'post_status' => 'publish'
    ];
    $post_id = wp_insert_post($postarr);

    foreach($params as $label => $value) {
        $message .= '<strong>' . ucfirst($label) . '</strong> : ' . $value . '<br>';
        add_post_meta($post_id, $label, $value);
    }

    wp_mail( $admin_email, $subject, $message, $headers );
    return new WP_REST_Response('the message sent', 200);
}