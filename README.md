# kata-greed
![PHP](https://github.com/vdebes/kata-greed/actions/workflows/php.yml/badge.svg)

test Inspired from [CodingDojo.org](https://codingdojo.org/kata/Greed/)

## Rules
Write a class Greed with a score() method that accepts an array of exactly 6 die values (1 to 6). Scoring rules are based on [the french game 10000](https://fr.wikipedia.org/wiki/10000#Jeu_%C3%A0_6_d%C3%A9s) as follows:

* A single one (100)
* Only two one (200)
* A single five (50)
* Only two five (100)
* Triple ones [1,1,1] (1000)
* Others triple are 100 times the dice value
  * [2,2,2] (200)
  * [3,3,3] (300)
  * [4,4,4] (400)
  * [5,5,5] (500)
  * [6,6,6] (600)
* Fourth dice of the same value multiply the triple score by 2.
* Five dice of the same value multiply the triple score by 4.
* Six dice of the same value multiply the triple score by 10.
* Three Pairs [2,2,3,3,4,4] (800)
* Small straight [1, 2, 3, 4, 5] or [2, 3, 4, 5, 6] (600)
* Straight [1,2,3,4,5,6] (1200)

All rules are exclusive, so dice can only count for one rule.

## Example
* [1, 2, 2, 4, 5, 5] should score 200
* [1, 2, 2, 2, 5, 5] should score 400
* [1, 2, 3, 4, 5, 5] should score 650
* [1, 1, 5, 3, 3, 3] should score 550
* [1, 2, 3, 4, 5, 6] should score 1200
* [1, 1, 1, 2, 4, 5] should score 1050
* [1, 1, 1, 3, 5, 5] should score 1100
* [1, 1, 1, 1, 5, 5] should score 2100
* [2, 2, 2, 3, 3, 3] should score 500
* [2, 2, 2, 2, 2, 3] should score 800
* [2, 2, 2, 2, 2, 2] should score 2000
* [1, 1, 2, 2, 5, 5] should score 800

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