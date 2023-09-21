<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite50592a40b50f1020782bacc2790e34d
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
            'Moham\\Klachtverwerking\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'Moham\\Klachtverwerking\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInite50592a40b50f1020782bacc2790e34d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite50592a40b50f1020782bacc2790e34d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite50592a40b50f1020782bacc2790e34d::$classMap;

        }, null, ClassLoader::class);
    }
}
