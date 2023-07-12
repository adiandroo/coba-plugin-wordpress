<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita5d713d50a0e5832815f881423d9d176
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Carbon_Fields\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Carbon_Fields\\' => 
        array (
            0 => __DIR__ . '/..' . '/htmlburger/carbon-fields/core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita5d713d50a0e5832815f881423d9d176::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita5d713d50a0e5832815f881423d9d176::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita5d713d50a0e5832815f881423d9d176::$classMap;

        }, null, ClassLoader::class);
    }
}