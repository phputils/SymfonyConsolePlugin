<?php

namespace PHPUtils\SymfonyConsolePlugin;

use Symfony\Component\Console\CommandLoader\FactoryCommandLoader;
use Symfony\Component\Console\Application;

abstract class ApplicationPluginLoader
{

    public static $commandBindings = [];

    public static function registerCommand(string $commandName, string $commandClass)
    {
        static::$commandBindings[$commandName] = $commandClass;
    }

    public static function bindCommands(Application $application)
    {
        $factories = [];
        foreach (static::$commandBindings as $commandName => $commandClass) {
            $factories[$commandName] = function() use ($commandClass){ return new $commandClass; };
        }
        $loader = new FactoryCommandLoader($factories);
        $application->setCommandLoader($loader);
    }

}
