#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\SingleCommandApplication;
use Vdebes\KataGreed\Greed;
use Vdebes\KataGreed\Scoring;

(new SingleCommandApplication())
    ->setName('greed')
    ->addArgument('die', InputArgument::REQUIRED, 'Number of die rolled')
    ->setCode(
        function (InputInterface $input, OutputInterface $output) {
            $output->writeln('Please enter the value of your 6 dice.');

            /** @var array{0: int, 1: int, 2: int, 3: int, 4: int, 5: int} $rollsResult */
            $rollsResult = [];
            $helper = new QuestionHelper();
            for ($i = 1; $i <= 6; $i++) {
                $question = new Question(
                    "Dice $i result? "
                );

                $question->setValidator(
                    function ($answer) {
                        $answer = (int) $answer;
                        if ($answer < 1 || $answer > 6) {
                            throw new \RuntimeException(
                                'A dice roll should give a score between 1 and 6.'
                            );
                        }

                        return $answer;
                    }
                );
                $question->setMaxAttempts(2);

                $rollsResult[$i - 1] = (int) $helper->ask($input, $output, $question);
            }

            $dice = implode(', ', $rollsResult);
            $output->writeln("You rolled $dice.");

            $greed = new Greed(
                new Scoring\ThreePairsRule(),
            );
            $score = $greed->score($rollsResult);

            $output->writeln("You scored $score!");
        }
    )
    ->run();
