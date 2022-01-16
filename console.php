#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\SingleCommandApplication;
use Vdebes\KataGreed\Greed;

(new SingleCommandApplication())
    ->setName('greed')
    ->addArgument('die', InputArgument::REQUIRED, 'Number of die rolled')
    ->setCode(function (InputInterface $input, OutputInterface $output) {
        $dieCount = $input->getArgument('die');
        $minimalDieCount = 3;
        $maximumDieCount = 6;
        if ($dieCount < $minimalDieCount || $dieCount > $maximumDieCount) {
            throw new InvalidArgumentException("You can only roll $minimalDieCount to $maximumDieCount die.");
        }

        $output->writeln("You chose to play with $dieCount die.");

        $rollsResult = [];
        $helper = new QuestionHelper();
        for ($i=1; $i<=$dieCount; $i++) {
            $question = new Question(
                "Dice $i result? "
            );

            $question->setValidator(function ($answer) {
                $answer = (int) $answer;
                if ($answer < 1 || $answer > 6) {
                    throw new \RuntimeException(
                        'A dice roll should give a score between 1 and 6.'
                    );
                }

                return $answer;
            });
            $question->setMaxAttempts(2);

            $rollsResult[] = $helper->ask($input, $output, $question);
        }

        $output->writeln('You rolled '.implode(', ', $rollsResult));

        $greed = new Greed();

        $table = new Table($output);
        $table
            ->setHeaders(['Rolls', 'Score'])
            ->setRows([
                ['1, 1, 1', '+100'],
                ['1', 'x2'],
                ['5', '+50'],
                new TableSeparator(),
                ['1, 1, 1, 1, 5', '250'],
            ])
        ;

        $table->render();
    })
    ->run();
