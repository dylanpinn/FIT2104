---
title: FIT2104 - Lecture 4
subtitle: Introduction to PHP
---

# Lecture 4

## Overview

1. Introduction to PHP
2. PHP Data types and Operators
3. PHP language contructs

## Introduction to PHP

- Originally stood for Personal Home Page tools
- Conceived in 1994 by Rasmus Lerdorf to track visitors to his online resume.
- Form interpreter added in 1995
- In 1997 2 Israeli students joined Lerdorf and re-wrote the entire
  implementation.
- PHP 3.0 released in 1998 as Open Source and became immediately popular with
  web developers.
- Latest version 7.1.31 released in August 2019.
- Recent estimates put PHP usage at 79% of all websites where the server-side
  language is known.

### What is PHP

- PHP is a server-side, cross-platform, HTML embedded scripting language
- Server-side
  - Everything PHP does executes on the web server.
  - PHP instructions are processed by the server and HTML is generated and sent
    to the browser for display
- Cross-platform
  - Can run on Windows, Unix, Macintosh, etc.
- HTML embedded
  - PHP commands are placed within HTML tags
  - PHP pages are much like ordinary HTML pages that "escape" into PHP mode only
    when necessary.
- Scripting language
  - Not a fully fledged programming language such as Java,C or C#.
  - Cannot be used to write stand-alone applications as scripting languages are
    designed to something only after an event occurs, such as a user requesting
    a web page.
  - Interpreted is the term often used for scripting languages which cannot act
    on their own and compiled is used for languages such as C or Java which can.
  - PHP pages must be served from a web server.

### Getting started with PHP

- PHP files must be saved with an extension of `.php`
- PHP files cannot be viewed directly via a browser from a local machine (i.e.
  using the file protocol), must be served from a web server.
- The PHP engine (on the web server) needs to know which section(s) of the file
  to execute
  - This is accomplished by indicating the PHP code blocks with delimiters
  ```php
  <?php .... ?>
  ```

## PHP variables

- Variables are containers for storing information.
- PHP is considered a weakly-typed scripting language.
  - You cannot declare a variable before you use it.
  - You cannot declare a variable of a particular datatype.
- PHP creates a variable when you assign a value to it and assign that variable
  a datatype based on the values assigned to it -
  ```php
  $firstName = "Bill";
  ```
- PHP variable names
  - Must be prefixed with a `$`.
  - Must start with a letter or an underscore
  - Can only contain alphanumeric characters or underscores
  - Are case sensitive
    - `$firstName` is NOT the same as `$FirstName`

## PHP variable comparison operators

| Operator     | Name                                         |
| ------------ | -------------------------------------------- |
| `==`         | Equality                                     |
| `!=` OR `<>` | Inequality                                   |
| `<`          | Less than                                    |
| `>`          | Greater than                                 |
| `<=`         | Less than or equal to                        |
| `>=`         | Greater than or equal to                     |
| `===`        | Equality/datatype equality.                  |
|              | Return true if value AND datatypes are equal |
| `&&`         | AND                                          |
| `||`         | OR                                           |
| `!`          | NOT                                          |

## PHP datatypes

### Strings

- Everything stored between single _OR_ **bold** double quotation marks
  ```php
  $CarType = "Holden";
  $CarType = 'Holden';
  ```
- Concatenation character is `.`
  ```php
  $CarType = "Holden";
  $CarModel = "Barina";
  echo $CarType . $CarModel;
  ```
  - To display with space - use double quotes around the whole thing
  ```php
  echo "$CarType $CarModel";
  ```
  - If you use single quotes
  ```php
  echo '$CarType $CarModel';
  ```
  - The variable names NOT the variable values will be displayed.

#### PHP string functions

| Function                  | Use                                            |
| ------------------------- | ---------------------------------------------- |
| `strlen`                  | Returns the length of a string                 |
| `substr(str, start, len)` | Extracts `len` number of characters from `str` |
|                           | beginning at position `start`                  |
| `chop`                    | removes whitespace form right of string        |
| `trim`                    | removes whitespace from start                  |
|                           | and end of string                              |
| `strpos(search, find)`    | returns int pos. of 1st occur. of `find`       |
| `strrpos(search, find)`   | returns the int pos. of last                   |
|                           | occur. of `find`                               |
| `strtoupper`              | convert string to upper case                   |
| `strtolower`              | convert string to lower case                   |
| `ucfirst`                 | capitalise first character of string           |
| `uswords`                 | capitalise first character of each word        |
| `explode(sep, str)`       | returns an array of string                     |
| `implode(sep, arr)`       | returns a string of all `arr` elms. joined     |
|                           | with `sep`                                     |

### Numerics

- PHP allows only 2 types of numeric datatypes, integers and doubles (floating
  point numbers).
- Variables of numeric type can make use of the Math operators:
  - `+` Addition
  - `-` Subtraction
  - `*` Multiplication
  - `/` Division
  - `%` Modulus

#### Math Functions

- PHP has various Math functions which provide rounding, calculating square
  roots, converting to Octal or Hex, etc.
  - The `rand(min, max)` function returns a random integer between `min` and
    `max`
  - Incrementing numeric variables is done in the same was a Java, C++, etc.:
    ```php
    $intVar = 1;
    $intVar = $invVar + 1;
    // OR
    $intVar += 1;
    // OR
    $intVar++;
    ```

### Constants

- Constant variables have their value fixed, i.e. once the value is assigned to
  the variable, it cannot be changed.
- PHP constants
  - are not prefixed by a `$`
  - May only be defined by using the `define()` function
  - may be defined and accessed anywhere without regard to scoping rules, i.e.
    they are global and are automatically accessible within functions.
  - by convention use uppercase
    ```php
    define("ABSOLUTEZER0", 0);
    define("FIRST_PRIME_MINISTER", "Edmund Barton");
    ```
  - Need to ensure we don't use PHP reserved words such as `switch`, `function`,
    `if`, etc.

### Datatype manipulation

- PHP assigns a subtype value to a variable when we assign a value
  - We can use `gettype($variable)` to view this subtype.
  - We can also specify or change the datatype using `settype($variable, type)`
    or by using the more familiar casting syntax `(type) $variable;`
  - Other variable functions which are useful
    - `isset` - determines if a variable with the given name exists. Will return
      a `1` if the variable exists or `0` (number) or `""` (string) or else will
      return nothing.
    - `empty` - will return a `1` if a variable doesn't exist or is equal to `0`
      (number) or `""` (string) or else will return nothing.
    - `unset` - destroys a variable and will release any resources it was
      consuming.

### Arrays

- Arrays are collections of, usually related, values stored under a single name.
- PHP does not require a value to be stored in each element and values to do not
  have to be stored sequentially
  ```php
  $OzStates[] = "Victoria";
  $OzStates[] = "South Australia";
  ```
- This will create an array and add the value `Victoria` to element `0` and
  `South Australia` to element `1`.
  ```php
  $OzStates[0] = "Victoria";
  $OzStates[4] = "South Australia";
  ```
- This will create an array and add the value `Victoria` to element `0` and
  `South Australia` to element `4`.
- Populate multiple elements
  ```php
  $OzStates = array("Victoria", "South Australia", "Tasmania");
  ```
- Populate multiple elements and specify start position
  ```php
  $OzStates = array(2 => "Victoria", "South Australia", "Tasmania");
  ```

#### Array functions

| Name        | Functionality                                    |
| ----------- | ------------------------------------------------ |
| `current`   | Access contents of current array element         |
| `next/prev` | Move pointer to next/prev array element          |
| `reset`     | Resets internal array pointer to first element   |
| `end`       | Moves pointer to last element of array           |
| `key`       | Access index value of current array element      |
| `list/each` | Returns only elements in array that contain data |
| `foreach`   | Loop over each value in the array                |

#### Array sorting

| Name     | Functionality                                                   |
| -------- | --------------------------------------------------------------- |
| `sort`   | Sort elements from low to high and assigns new keys to elements |
| `rsort`  | Sort elements from high to low and assigns new keys to elements |
| `asort`  | Sort element values from low to high and retains existing keys  |
| `arsort` | Sort elements from high to low and retains existing keys        |

### Comments

```php
// Generally used to add a comment on a single line.
/* Generally used when the comment is longer and will extend over more than
   one line */
```

## PHP language constructs

PHP has 3 ways of determining the sequence of code execution

- branching
  - deciding which of two or more sections of code to run, e.g. `if`...`else`
    statements.
- looping
  - repeating a section of code as many times as required, e.g. `while` loops
- jumping
  - jumping out of the code sequence and executing sections of code in another
    part of the PHP code or even another PHP file, `e.g.` function calls.

### Branching statements

- `if`...`else`
- ternary
- `switch`

#### `if....else`

```php
$a = 7;
$b = 5;
if ($a < $b) {
  echo "a is less then b";
} else {
  echo "a is not less than b";
}
```

##### `if...elseif...else`

```php
$a = 7;
$b = 7;
if ($a < $b) {
  echo "a is less then b";
} elseif ($a == $b) {
  echo "a is equal to b";
} else {
  echo "a is greater than b";
}
```

#### Ternary operators

- acts just like an `if...else` statement but is written all one one line.
- Known as the conditional operator in some programming languages.
  ```php
  $a = 6;
  $b = 5;
  echo $a < $b ? "a is less than b" : "a is not less than b";
  ```
- achieves the same result as the previous `if...else` example.

#### Switch statement

```php
$grade = 75;
switch($grade) {
  case $grade >= 80:
    echo "HD";
    break;
  case $grade >= 70:
    echo "D";
    break;
  case $grade >= 60:
    echo "C";
    break;
  case $grade >= 50:
    echo "P";
    break;
 default:
  echo "uh oh";
```

- The order of statements is important as the statement will end after the first
  match is found.
- The `break` command must be used to end each case otherwise the statement
  would continue on.
- The `default` case will be executed if none of the previous cases are matched
- Multiple matches
  ```php
  $reply = "Y";
  switch ($reply) {
    case "Y":
    case "y":
    case "Yes":
    case "yes":
      echo "you answered yes";
      break;
    case "N":
    case "n":
    case "No":
    case "no":
      echo "you answered no";
      break;
    }
  ```

### Loops

- Loops are used for repeating statements or groups of statements, multiple
  times.
  ```php
  for ($counter = 1; $counter <= 3; $counter++) {
    echo "This loop will execute 3 times <br />";
  }
  ```
- `while` loop tests a condition at the beginning of the loop and continues
  processing until the condition is true.
  ```php
  $loan = 600;
  while ($loan > 0) {
    echo "You still owe " . $loan . "<br />";
    $loan -= 200;
  }
  echo "Your loan is now repaid";
  ```
- `do...while` loop works in much the same way, although the test is at the end,
  so the loop will always execute at least once
  ```php
  $loan = 600;
  do {
    echo "You still owe " . $loan . "<br />";
    $loan -= 200;
  } while ($loan > 0);
  echo "Your loan is now repaid";
  ```

### Functions

- Functions allow a programmer to pause execution of the current section of code
  and jump to another named block of code.
- Once this block of code has been executed, control is returned to the original
  section of code and execution continues
  ```php
  function funcName([argument_list]) {
    [statement(s);]
    [return return_value;]
  }
  ```

#### Examples

```php
$salary = 1600;
$taxRate = 25;
function CalcTax($salary, $taxRate) {
  $salary -=($salary*($taxRate/100));
  return $salary;
}
echo "Salary after tax is ". CalcTax($salary, $taxRate). "<br />";
echo "The value of \$salary is now" . $salary."<br />";
```

- Passing by reference - the actual memory location of the variable is passed to
  the function and the original variable is changed permanently
  ```php
  $salary = 1600;
  $taxRate = 25;
  function CalcTax(&$salary, $taxRate) {
    $salary -= ($salary * ($taxRate / 100));
    return $salary;
  }
  echo "Salary after tax is ". CalcTax($salary, $taxRate). "<br />";
  echo "The value of \$salary is now" . $salary."<br />";
  ```

### Include files

- Useful for thins such as menus or database connection strings that you want
  all PHP pages within an application to have access to

  ```php
  // header.php
  <table>
    <tr> <td> The Amazing FIT2104 Web Company </td> </tr>
  </table> <br />
  <table cellspacing="5">
    <tr>
      <td><a href="home.php">Home</a></td>
      <td><a href="page1.php">Page 1</a></td>
      <td><a href="page2.php">Page 2</a></td>
    </tr>
  </table>

  // footer.php
  <table>
    <tr>
      <td>FIT2104 Company. All content copyright.</td>
    </td>
  </table>

  // home.php
  <?php include('header.php'); ?>
  Page content goes here
  <?php include('footer.php'); ?>
  ```

- PHP also contains another method for including files, using the `require()`
  function.
- Both of these functions use the same syntax and work in the same manner, apart
  from one major and other minor difference.
- The `require` function will always be called, regardless of where it is within
  the script, even if it is the result of a condition that evaluates to false.
- The `include` function will only take effect if the function is called within
  the execution of the script.
- Additionally if include is used and the file to be included is not present, an
  error will be reported and the rest of the script will be executed.
- If a required file is not present an error will be reported and execution of
  the script will halt.
