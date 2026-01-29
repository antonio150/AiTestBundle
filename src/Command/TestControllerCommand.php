<?php 
namespace AiTestBundle\Command;

use AiTestBundle\Service\ControllerAnalyzer;
use AiTestBundle\Service\TestGenerator;
use AiTestBundle\Service\TestRunner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'ai:test-controller')]
class TestControllerCommand extends Command
{
    public function __construct(
        private ControllerAnalyzer $analyzer,
        private TestGenerator $generator,
        private TestRunner $runner
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('controller', InputArgument::REQUIRED, 'Nom du controller');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $controller = $input->getArgument('controller');

        $methods = $this->analyzer->analyze($controller);
        $this->generator->generate($controller, $methods);
        $result = $this->runner->run();

        $output->writeln('Tests exécutés :');
        $output->writeln($result);

        return Command::SUCCESS;
    }
}
