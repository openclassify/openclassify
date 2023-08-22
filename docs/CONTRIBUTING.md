# Contribution Guide

It's been often said that programming is part art, part science - that because lots of times there's no single, simple solution to a problem; or if there is, we might not know about it. There's also an infamous joke that if there are *n* developers in the room, then there are *n+1* opinions on how things should be done.

### The most important thing

**The code has to work.** Unless you open a PR as a work in progress, the code should be built and tested on a device or emulator. Having people review your code is one thing, but you should not expect them to also *test* the code for you. 

### Context

Some of those might be more urgent than the others, and sometimes you might be under pressure to ship as soon as possible so the code might not be perfect or there won't be any tests or code might not be extendable. **That's ok.** 

## Everyone

* There is no perfect code: good enough is usually good enough. That being said, try to keep the number of WTFs per minute to a minimum.
  
![](https://i2.wp.com/commadot.com/wp-content/uploads/2009/02/wtf.png?w=550)

* Accept that many programming decisions are opinions.  Discuss tradeoffs, which you prefer, and reach a resolution quickly.
* Ask for clarification. ("I didn't understand. Can you clarify?")
* Offer clarification, explain the decisions you made to reach a solution in question.
* Avoid using terms that could be seen as referring to personal traits. ("dumb", "stupid"). Assume everyone is intelligent and well-meaning.
* Be humble. ("I'm not sure - let's look it up.")
* Don't use hyperbole. ("always", "never", "endlessly", "nothing") Don't use sarcasm.
* Remember that you're both on the same side - the goal is to make the code better. Understand that sometimes your ideas will be overruled. Even if you do turn out to be right, don't take revenge or say, "I told you so".
* Talk synchronously (e.g. chat, screensharing, in person) if there are too many "I didn't understand" or "Alternative solution:" comments. Pull requests should not be the place for long discussions, architectural or otherwise.
* Put notes on what's missing or could be improved in the PR description or comments. You can also create an issue with discussion points and possible problems or things to do and discuss it offline.

## As a code submitter

* PRs should be about one thing. If you do multiple things in one PR, it's hard to review. If you're fixing stuff as you go, you might want to make atomic commits and then cherry-pick those commits into separate branches, leaving the PR clean.
* Try to keep the PRs small. There has been some research to indicate that beyond 400 LOC the ability to detect defects diminishes. (We're talking about LOC proper, unit tests and layouts don't count)
* Having a PR description is useful. Additionally, you can also link to the card on Trello.
* Ideally, the PR should be finished when submitted. If the PR is work in progress, add (WIP) or [WIP] to the title. 
* You should have tests that at least cover the logic, and ideally also cover the input/output parameters and methods. (depends on context)

## As a reviewer

* Reviewing code is part of a normal workday. You should check for open/updated PRs at least once a day. 
* Ask, don’t tell. (“What do you think about trying…?” rather than “Don’t do…”)
* Offer ways to simplify or improve code.
* Code beautification and refactoring ought to be tasks in the next sprint, except for obvious and easy-to-fix things.
* Communicate which ideas you feel strongly about and those you don't. Explain your reasons why code should be changed. (Not in line with the style guide? A personal preference?)
* If you disagree strongly, consider giving it a few minutes before responding; think before you react.
* Offer alternative implementations, but assume the author already considered them. ("What do you think about using a custom validator here?")
* If discussions turn too theoretical or touch big architectural questions, move the discussion offline. In the meantime, let the author make the final decision on alternative implementations.
* Don't keep the code hostage. Keep in mind the context and the most important thing - does it work?

## Readability and Cleanliness

The first step is to make sure that your PHP code is clean and readable so that both you and other developers can easily understand it.

Make sure to consider the following issues:

* Is the code formatting written in the same style as the rest of the project?
* Is the code well-described with comments or other documentation?
* Is it easy to discern the purpose of a given PHP function or class?
* Does the code throw exceptions or display appropriate error messages when something goes wrong?
* Are any variable, function, or file names unclear or inconsistent?
* Are there still large blocks of code commented out that should be deleted?
* Are there duplicate sections of code that can be removed or condensed?
* Can large files be refactored or broken down into smaller components that are easier to comprehend?


# Task list to Check

## General
  - [ ] The code works
  - [ ] The code is easy to understand
  - [ ] Follows coding conventions
  - [ ] Names are simple and if possible short
  - [ ] Names are spelt correctly
  - [ ] Names contain units where applicable
  - [ ] There are no usages of [magic numbers](http://c2.com/cgi/wiki?MagicNumber)
  - [ ] No hard coded constants that could possibly change in the future
  - [ ] All variables are in the smallest scope possible
  - [ ] There is no commented out code
  - [ ] There is no dead code (inaccessible at Runtime)
  - [ ] No code that can be replaced with library functions
  - [ ] Variables are not accidentally used with null values
  - [ ] Variables are immutable where possible
  - [ ] Code is not repeated or duplicated
  - [ ] No complex/long boolean expressions
  - [ ] No negatively named boolean variables
  - [ ] No empty blocks of code
  - [ ] Ideal data structures are used
  - [ ] Constructors do not accept null/none values
  - [ ] Catch clauses are fine grained and catch specific exceptions
  - [ ] Exceptions are not eaten if caught, unless explicitly documented otherwise
  - [ ] Files/Sockets and other resources are properly closed even when an exception occurs in using them
  - [ ] == operator and === (and its inverse !==) are not mixed up
  - [ ] Floating point numbers are not compared for equality
  - [ ] Loops have a set length and correct termination conditions
  - [ ] Blocks of code inside loops are as small as possible
  - [ ] No methods with boolean parameters
  - [ ] No object exists longer than necessary
  - [ ] No memory leaks
  - [ ] Code is unit testable
  - [ ] Test cases are written wherever possible
  - [ ] Methods return early without compromising code readability
  - [ ] Performance is considered
  - [ ] Loop iteration and off by one are taken care of

## Architecture
  - [ ] [Law of Demeter](https://en.wikipedia.org/wiki/Law_of_Demeter) is not violated
  - [ ] A class should have only a single responsibility (i.e. only one potential change in the software's specification should be able to affect the specification of the class)
  - [ ] Classes, modules, functions, etc. should be open for extension, but closed for modification
  - [ ] Objects in a program should be replaceable with instances of their subtypes without altering the correctness of that program
  - [ ] Many client-specific interfaces are better than one general-purpose interface.
  - [ ] Depend upon Abstractions. Do not depend upon concretions.
 

## Security
  - [ ] All data inputs are checked (for the correct type, length/size, format, and range)
  - [ ] Invalid parameter values handled such that exceptions are not thrown
  - [ ] No sensitive information is logged or visible in a stacktrace


## Security Vulnerabilities

If you discover a security vulnerability, please send an e-mail to info@openclassify.com. All security vulnerabilities will be promptly addressed.


## Coding Style

Project follows the PSR-4, PSR-2 and PSR-1 coding standards. In addition to these standards, the following coding standards should be followed:

The class namespace declaration must be on the same line as <?php.
