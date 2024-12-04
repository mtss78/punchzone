<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit243b7d7a9fbc65a53198fc2a90b323b6
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Config\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'App\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit243b7d7a9fbc65a53198fc2a90b323b6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit243b7d7a9fbc65a53198fc2a90b323b6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit243b7d7a9fbc65a53198fc2a90b323b6::$classMap;

        }, null, ClassLoader::class);
    }
}