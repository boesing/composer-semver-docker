<?php
declare(strict_types=1);

namespace Boesing\ComposerSemverDocker;

use Composer\Semver\Semver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Webmozart\Assert\Assert;

final class ComposerSemverMatchCommand extends Command
{
    public const COMMAND_NAME = 'semver:match';

    public function __construct()
    {
        parent::__construct(self::COMMAND_NAME);
    }

    protected function configure(): void
    {
        $this->addArgument('version', InputArgument::REQUIRED, 'PHP version');
        $this->addArgument('constraints', InputArgument::REQUIRED, 'Constraint to match against');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $version = $input->getArgument('version');
        Assert::string($version);

        $constraints = $input->getArgument('constraints');
        Assert::string($constraints);

        if (Semver::satisfies($version, $constraints)) {
            $output->writeln(sprintf('Provided PHP version "%s" is satisfied by the constraints "%s"', $version, $constraints));

            return self::SUCCESS;
        }

        $output->writeln(sprintf('Provided PHP version "%s" is not satisfied by the constraints "%s"', $version, $constraints));
        return self::FAILURE;
    }
}
