# PHP Developer Coding Exemplar

## Instructions
This coding exemplar is designed to highlight your skills and areas of expertise with the PHP language in general. We rely mainly on PHP as our web technology of choice. Because of this, it's important that developers have a well-rounded understanding of the PHP language.

Please complete the following questions to the best of your ability. If you are unable to solve a question, please indicate as such. You should feel free to use the PHP manual and other resources to solve these questions; after all, we expect that our developers will use their problem-solving skills at work! Some questions are intended to be difficult, while others are meant to be easy or obvious. Please post your answers in a private Gist, using Markdown format, and send the link for review.

This exercise should take approximately one hour to complete.

Good luck!

## Question 1
A client has called and said that they're noticing performance problems on their database when searching for a user by email address. You've checked, and the following query is running:

```
SELECT * FROM users WHERE email = 'user@test.com';
```

You run the EXPLAIN command and get the following results:

```
+----+-------------+-------+------+---------------+------+---------+------+-------+-------------+
| id | select_type | table | type | possible_keys | key  | key_len | ref  | rows  | Extra       |
+----+-------------+-------+------+---------------+------+---------+------+-------+-------------+
|  1 | SIMPLE      | users | ALL  | NULL          | NULL | NULL    | NULL | 10320 | Using where |
+----+-------------+-------+------+---------------+------+---------+------+-------+-------------+
```

Offer a theory as to why the performance is slow.

## Question 2
You're given a sorted index array that contains no keys. The array contains only integers, and your task is to identify whether or not the integer you're looking for is in the array. Come up with a function that searches for the integer and returns true or false based on whether the integer is present. Describe how you arrived at your solution.

## Question 3
During a large data migration, you get the following error: Fatal error: Allowed memory size of 134217728 bytes exhausted (tried to allocate 54 bytes). You've traced the problem to the following snippet of code:

```php

$stmt = $pdo->prepare('SELECT * FROM largeTable');
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $result) {
	// manipulate the data here
}
```
Refactor this code so that it stops triggering a memory error.

## Question 4
Write a function that takes a phone number in any form and formats it using a delimiter supplied by the developer. The delimiter is optional; if one is not supplied, use a dash (-). Your function should accept a phone number in any format (e.g. 123-456-7890, (123) 456-7890, 1234567890, etc) and format it according to the 3-3-4 US block standard, using the delimiter specified. Assume foreign phone numbers and country codes are out of scope.

*Note:* This question CAN be solved using a regular expression, but one is not REQUIRED as a solution. Focus instead on cleanliness and effectiveness of the code, and take into account phone numbers that may not pass a sanity check.

## Question 5
In production, we'll be caching to memcache. On staging, we'll be caching to APC. In development, we won't be caching at all. Design a library that allows you to store and retrieve data from the cache (only two methods required) and fits the requirements of all three environments. Consider making use of anything appropriate (e.g. traits, classes, interfaces, abstract classes, closures, etc) to solve this problem.

Note: This is an architecture question. Please focus on the design of your library, rather than implementation or the specific caches I've described.

## Question 6
Write a complete set of unit tests for the following code:

```php

function fizzBuzz($start = 1, $stop = 100)
{
	$string = '';

	if($stop < $start || $start < 0 || $stop < 0) {
		throw new InvalidArgumentException;
	}

	for($i = $start; $i <= $stop; $i++) {
		if($i % 3 == 0 && $i % 5 == 0) {
			$string .= 'FizzBuzz';
			continue;
		}

		if($i % 3 == 0) {
			$string .= 'Fizz';
			continue;
		}

		if ($i % 5 == 0) {
			$string .= 'Buzz';
			continue;
		}

		$string .= $i;
	}

	return $string;
}
```

## Question 7
I've developed a class called Select to represent the SELECT statements I'd normally write for a database. I want to be able to use the Select objects as queries and automatically cast them to strings, but when I use them in PDOStatement::execute() I get the following error: Catchable fatal error: Object of class Select could not be converted to string. What should I change in my Select class so that this error goes away?

## Question 8

Refactor the following old legacy classes. Don't go too deep, estimate up to 15 minutes of work.
The code shouldn't be ideal, rather adequate for the first step of the refactoring.
Feel free to leave comments in places which can be improved in the future if you see a possibility of that.

```php
<?php

class Document {

    public $user;

    public $name;

    public function init($name, User $user) {
        assert(strlen($name) > 5);
        $this->user = $user;
        $this->name = $name;
    }

    public function getTitle() {
        $db = Database::getInstance();
        $row = $db->query('SELECT * FROM document WHERE name = "' . $this->name . '" LIMIT 1');
        return $row[3]; // third column in a row
    }

    public static function getAllDocuments() {
        // to be implemented later
    }
}

class User {

    public function makeNewDocument($name) {
        if(!strpos(strtolower($name), 'senior')) {
            throw new Exception('The name should contain "senior"');
        }

        $doc = new Document();
        $doc->init($name, $this);
        return $doc;
    }

    public function getMyDocuments() {
        $list = array();
        foreach (Document::getAllDocuments() as $doc) {
            if ($doc->user == $this)
                $list[] = $doc;
        }
        return $list;
    }
}
```
