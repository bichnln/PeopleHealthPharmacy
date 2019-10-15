<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite1fd93c564da27c3f4a866b6326a6c6a
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Phpml\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Phpml\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-ai/php-ml/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite1fd93c564da27c3f4a866b6326a6c6a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite1fd93c564da27c3f4a866b6326a6c6a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}