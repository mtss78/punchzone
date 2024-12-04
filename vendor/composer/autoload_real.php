<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit243b7d7a9fbc65a53198fc2a90b323b6
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit243b7d7a9fbc65a53198fc2a90b323b6', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit243b7d7a9fbc65a53198fc2a90b323b6', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit243b7d7a9fbc65a53198fc2a90b323b6::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
