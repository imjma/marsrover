<?php

namespace MarsRover;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

/**
 * Class Panel
 * @package MarsRover
 */
class Panel extends Command
{
    /**
     * @var OutputInterface
     */
    private $output;

    protected function configure()
    {
        $this->setName("rover:panel")
             ->setDescription("Panel to control rover on mars");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        $helper = $this->getHelper('question');

        // building plateau
        do {
            $question = new Question("Please enter the upper-right coordinates of the plateau. eg. 5 5\n");

            $coordinates = $helper->ask($input, $output, $question);
        } while (!$plateau = $this->createPlateau($coordinates));

        // deploying rover
        while (true) {
            do {
                $question = new Question("Please deploy rover to plateau. eg. 1 2 N\n");

                $position = $helper->ask($input, $output, $question);

            } while (!$rover = $this->deployRover($plateau, $position));

            // exploring
            $question = new Question("Please input command for the rover. eg. LMLMLMLMM\n");

            $command = $helper->ask($input, $output, $question);

            $rover->explore($command);

            $this->output->writeln($rover->printPosition());

            // another round?
            $question = new ConfirmationQuestion('Continue? (y/N)', false);

            if (!$helper->ask($input, $output, $question)) {
                break;
            }
        }
    }

    /**
     * Build plateau
     * @param $coordinates
     * @return bool|Plateau
     */
    private function createPlateau($coordinates)
    {
        [$x, $y] = explode(" ", $coordinates);

        $this->output->writeln("Plateau is building...");
        try {
            $plateau = Plateau::create($x, $y);

            return $plateau;
        } catch (\Exception $e) {
            $this->output->writeln($e->getMessage());

            return false;
        }
    }

    /**
     * Deploy rover to plateau
     * @param Plateau $plateau
     * @param         $position
     * @return bool|Rover
     */
    private function deployRover(Plateau $plateau, $position)
    {
        [$x, $y, $o] = explode(" ", $position);

        try {
            $this->output->writeln("Initialize position...");
            $position = Position::locate($x, $y, $o);
            $this->output->writeln("position located");
        } catch (\Exception $e) {
            $this->output->writeln($e->getMessage());

            return false;
        }

        try {
            $this->output->writeln("Deploy rover to plateau...");
            $rover = $plateau->deploy($position);

            return $rover;
        } catch (\Exception $e) {
            $this->output->writeln($e->getMessage());

            return false;
        }

    }
}