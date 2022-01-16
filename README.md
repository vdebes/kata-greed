# kata-greed
![PHP](https://github.com/vdebes/kata-greed/actions/workflows/php.yml/badge.svg)

Inspired from [CodingDojo.org](https://codingdojo.org/kata/Greed/)

## Rules
Write a class Greed with a score() method that accepts an array of die values (up to 6). Scoring rules are as follows:

* A single one (100)
* A single five (50)
* Triple ones [1,1,1] (1000)
* Triple twos [2,2,2] (200)
* Triple threes [3,3,3] (300)
* Triple fours [4,4,4] (400)
* Triple fives [5,5,5] (500)
* Triple sixes [6,6,6] (600)

Note that the scorer should work for any number of dice up to 6.

* Four-of-a-kind (Multiply Triple Score by 2)
* Five-of-a-kind (Multiply Triple Score by 4)
* Six-of-a-kind (Multiply Triple Score by 8)
* Three Pairs [2,2,3,3,4,4] (800)
* Straight [1,2,3,4,5,6] (1200)

## Constraints
* Start first with a single class with a single method, ie a naïve approach
* Refactor to keep cyclomatic complexity below 10

## Bonus
* Output the calculation details in the console

## Hints
* Focus toward getting the total score first
* Use a design pattern.

## Tools
All tools are described running ```make help```.

## Kickstart
A basic class and test are already setup. 

A basic console command is also available to play the game, assuming you can roll die. The output result is a mockup to 
guide you but is not a constraint. Feel free to adapt it, for example if you do not plan on doing the bonus part. 

To use the app, run ```php console.php```