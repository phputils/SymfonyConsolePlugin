<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use PHPUtils\SymfonyConsolePlugin\ApplicationPluginLoader;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputOption;

final class ApplicationPluginLoaderTest extends TestCase
{
    public function testLoadingApplicationCommand(): void
    {
        // create application
        $application = new Application('Test Application','0.0');
        // register command
        ApplicationPluginLoader::registerCommand('test:command',"TestCommand");
        // bind command
        ApplicationPluginLoader::bindCommands($application);
        // get the command out by name
        $command = $application->get('test:command');
        $this->assertInstanceOf(TestCommand::class, $command);
    }
}

class TestCommand extends Command{
    protected static $defaultName = 'test:command';
}
