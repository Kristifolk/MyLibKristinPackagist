<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6d7277d0e8c7a33e29cf8e9b7de831e8
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MyLib\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MyLib\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6d7277d0e8c7a33e29cf8e9b7de831e8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6d7277d0e8c7a33e29cf8e9b7de831e8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6d7277d0e8c7a33e29cf8e9b7de831e8::$classMap;

        }, null, ClassLoader::class);
    }
}
