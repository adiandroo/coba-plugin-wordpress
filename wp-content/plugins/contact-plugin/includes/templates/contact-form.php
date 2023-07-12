<div id="form_success" style="background:green; color:#fff;"></div>
<div id="form_error" style="background:red; color:#fff;"></div>
<form id="enquiry_form">
    <?php wp_nonce_field('wp_rest');?>
    <label for="">Name</label>
    <input type="text" name="name"><br>
    <label for="">Phone</label>
    <input type="text" name="phone"><br>
    <label for="">Email</label> 
    <input type="text" name="email"><br>
    <label for="">Your message</label>
    <textarea name="message"></textarea><br>
    
    <button type="submit">Submit</button>
</form>

<script>
    jQuery(document).ready(function($) {
        $("#enquiry_form").submit(function(event) {
            event.preventDefault();
            var form = $(this);
            $.ajax({
                type: "POST",
                url: "<?php echo get_rest_url(null, 'v1/contact-form/submit'); ?>",
                data: form.serialize(),
                success: function() {
                    form.hide();
                    $("#form_success").html("You message was successfully sent").fadeIn();
                },
                error: function() {
                    $("#form_error").html("You message was error").fadeIn();
                }
            })
        });
    });
</script>
