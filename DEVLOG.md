# Development log

## Naive approach 
This part is now finished. All rules have been implemented, test first. I must admit it was painful.
I followed a very procedural approached which was difficul to reason about. 
I guess some objets would have come in handy instead of arrays, but I was focused on delivering 
a working program first, not a maintainable one.

I had to fix a bug at one point in time. Having a separate test for the bug only helped to 
debug, because the way I organised my tests did not allow me to run them case by case. This 
is the drawback of data providers. Moreover, the tests reflect my coding approach : all data, 
no behaviour.

Now is the time to refactor. I am tempted by going full objects right now but I have a feeling 
that cleaning up the procedural code will reveal behaviour.

## Refactoring
I do not see of to refactor without bringing more meaning without using objects. What appears is 
  * we identify patterns in the sequences of integers
  * each of these patterns give a score
  * this score is multiplied at the end
There I have a first class candidate, Pattern, with a first behaviour, give a score. So let's create 
such a class and introduce it in our code. The part calculating the score from a straight seems ideal 
since the pattern matching is dead simple and the return an integer, not one of those tricky arrays.

Now that I have introduced the new class, I need to give it autonomy to do its job without me knowing how, 
ie encapsulation. For this, it needs this occurences array I set in the Greed constructor. 

Since multiplier is an operation to do at the end, I will skip it for now and focus on the next rule, 
which is getScoreFromTriples. I will create a new rule, but without thinking about a common interface for now.
There is too much mess in the Greed class for that.

__note: I should write all this in the commit messages instead of this log.__

The test breaks because the refactored method tampered with a property from the Greed class (occurences). 
I need to fix with the least amount of effort. I do not want to fall into overthinking. This is why I just 
shunt a return value with a class property and a getter in the Triple rule.

Next to refactor since to be the Singles, since it is the closest to triple in terms of behaviour.

Singles went well. No shunt to do here. Each time I just move the private method related to the rule in a 
dedicated class and rename it to getPoints(). This method name is not correct at this point in time. It reflects 
where I want to go. I do not worry too much about the heterogenous return types here. First, I split the Greed class.

Now is the time to let a common interface emerge from the rules. I said earlier the method naming getPoints() 
was showing were I wanted to go: getPoints should return points to add to the total score, not this array<int, int>.
So let's get the rules out of this behaviour one by one.

Now that all rules have the same method with the same return type, I can extract a common interface. 
I also declare each rule final since I do not want a rule to have be capable of inheritance.

As I said, I hate arrays. They occupy too much RAM in my brain. I prefer to reason about objects. 
The occurences are hard to reason about, so let's add a new class to make the reasoning easier.