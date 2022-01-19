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
