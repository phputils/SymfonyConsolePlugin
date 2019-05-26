<?php

namespace PHPUtils\Plugin;

use Symfony\Component\Console\CommandLoader\FactoryCommandLoader;
use Symfony\Component\Console\Application;

abstract class consolePluginLoader
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
            $factories[$commandName] = function(){ return new $commandClass; };
        }
        $loader = new FactoryCommandLoader($factories);
        $application->setCommandLoader($loader);
        static::setBound();
    }

}
