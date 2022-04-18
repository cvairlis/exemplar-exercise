# PHP Developer Coding Exemplar Answers

## Question 1
### I see the following that could lead to a poor performance:
1. `type: ALL` & `Extra: Using where` indicate that a full table scan has been done.
2. `possible_keys: NULL` indicates that there are no relevant indexes.
3. `key & key_len: NULL` indicates that MySQL found no index to use for executing the query more efficiently.
4. `ref: NULL` the above indicate that there is no index in the table, so we were expected to see `NULL` also in this column.
5. `rows: 10320` indicates that for one email, MySQL examined the whole table to find occurencies. Here we would see 1.

## Question 2
This is definetely a `divide and conquer` problem. A matter of decomposition.
```php
<?php

function binarySearch(int $needle, array $haystack): bool
{
    // check for empty array
    if (count($haystack) === 0){
        return false;
    }
    $low = 0;
    $high = count($haystack) - 1;

    while ($low <= $high) {
        // compute middle index
        $mid = floor(($low + $high) / 2);
        // element found at mid
        if($haystack[$mid] == $needle) {
            return true;
        }
        if ($needle < $haystack[$mid]) {
            // search the left side of the array
            $high = $mid -1;
        }
        else {
            // search the right side of the array
            $low = $mid + 1;
        }
    }
    //  element does not exist
    return false;
}
```

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
Complete set of unit tests for the FizzBuzz algorithm

```php

<?php

namespace Tests\Unit\FizzBuzz;

use ExemplarCode\FizzBuzz\FizzBuzz;
use InvalidArgumentException;
use Tests\Unit\UnitTestCase;

class FizzBuzzTestCase extends UnitTestCase
{
    private function makeFizzBuzz(): FizzBuzz
    {
        return new FizzBuzz();
    }

    public function throws_exception_data_provider():array
    {
        return [
            '$stop < $start' => [100, 99],
            '$start < 0' => [-10, 10],
            '$stop < 0' => [10, -10]

        ];
    }

    /**
     * @test
     *
     * @dataProvider throws_exception_data_provider
     */
    public function it_throws_exception_for_invalid_values_on_start_stop(int $start, int $stop):void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->makeFizzBuzz()->fizzBuzz($start, $stop);
    }

    public function success_calculation_data_provider():array
    {
        return [
            [1, 1, '1'],
            [2, 2, '2'],
            [3, 3, 'Fizz'],
            [4, 4, '4'],
            [5, 5, 'Buzz'],
            [6, 6, 'Fizz'],
            [7, 7, '7'],
            [8, 8, '8'],
            [9, 9, 'Fizz'],
            [10, 10, 'Buzz'],
            [11, 11, '11'],
            [12, 12, 'Fizz'],
            [13, 13, '13'],
            [14, 14, '14'],
            [15, 15, 'FizzBuzz'],
            [30, 30, 'FizzBuzz'],
            [75, 75, 'FizzBuzz'],
            [1, 6, '12Fizz4BuzzFizz'],
        ];
    }

    /**
     * @test
     *
     * @dataProvider success_calculation_data_provider
     */
    public function it_returns_correct_string_sequence(int $start, int $stop, string $expected):void
    {
        $fizz_buzz = $this->makeFizzBuzz()->fizzBuzz($start, $stop);
        $this->assertEquals($expected, $fizz_buzz);
    }

    public function fizz_data_provider():array
    {
        $haystackay = [];
        for ($i = 1; $i <= 100; $i++) {
            if (!($i % 3 == 0 && $i % 5 == 0) && ($i % 3 == 0)) {
                $haystackay[] = [$i];
            }
        }

        return $haystackay;
    }

    /**
     * @test
     *
     * @dataProvider fizz_data_provider
     */
    public function it_returns_fizz_when_multiplies_of_three_but_not_five(int $value):void
    {
        $this->assertEquals('Fizz', $this->makeFizzBuzz()->fizzBuzz($value, $value));
    }

    public function buzz_data_provider():array
    {
        $haystackay = [];
        for ($i = 1; $i <= 100; $i++) {
            if (!($i % 3 == 0 && $i % 5 == 0) && ($i % 5 == 0)) {
                $haystackay[] = [$i];
            }
        }

        return $haystackay;
    }

    /**
     * @test
     *
     * @dataProvider buzz_data_provider
     */
    public function it_returns_buzz_when_multiplies_of_five_but_not_three(int $value):void
    {
        $this->assertEquals('Buzz', $this->makeFizzBuzz()->fizzBuzz($value, $value));
    }

    public function fizz_buzz_data_provider():array
    {
        $haystackay = [];
        for ($i = 1; $i <= 100; $i++) {
            if ($i % 3 == 0 && $i % 5 == 0) {
                $haystackay[] = [$i];
            }
        }

        return $haystackay;
    }

    /**
     * @test
     *
     * @dataProvider fizz_buzz_data_provider
     */
    public function it_returns_fizzbuzz_when_multiplies_of_three_and_five(int $value):void
    {
        $this->assertEquals('FizzBuzz', $this->makeFizzBuzz()->fizzBuzz($value, $value));
    }

    public function number_data_provider():array
    {
        $haystackay = [];
        for ($i = 1; $i <= 100; $i++) {
            if (!($i % 3 == 0 && $i % 5 == 0) && !($i % 3 == 0) && !($i % 5 == 0)) {
                $haystackay[] = [$i];
            }
        }

        return $haystackay;
    }

    /**
     * @test
     *
     * @dataProvider number_data_provider
     */
    public function it_returns_the_number_when_non_of_the_above_exist(int $value):void
    {
        $this->assertEquals($value, $this->makeFizzBuzz()->fizzBuzz($value, $value));
    }
}

```

## Question 7
The `PDOStatement::execute()` function attempts to convert the `Select` object to a string but finds that there is not __toString function declared.

So either declare the php function

```php
public function __toString() {
    return $the_string;
}
```

or create another public function/member that you can pass to the execute function.

## Question 8
Assuming that it is part o a production operating code, we MUST not change the public functions signature.
### User class changes:
- in the `makeNewDocument` function, a validation for the Document properties is made. We must move this logic to `Document` class.
- in the `getMyDocuments` function, we removed the foreach loop, and leave the job to the Document class, which has already has control of the User.

### Document class changes:
- We avoid creating `__construct` function accepting parameters because all related classes that use the `new Document()` declaration to instantiate document objects, will stop operating.
- But we create `__construct` function without accepting parameters to instantiate a new DB instance.
- We create setter `setName` function and we move all validation related with document inside.
- In the `init` function we use the `setName` to set the name, to also perform the validation check.
- We removed the `assert` function because it is rather a function that used for development purposes creating warning non viewable to users (depending the configuration always).
- In the `getTitle` function we changed the query, by selecting only the title column and fetch the zero index column. Not perfect but better approach.
- I changed the function that fetches all the documents for a user. I changed the name and the accepting property. New function name `getDocumentsForUser`. Read the php docs of the function for more.
-

```php
<?php

class Document {

    public $user;

    /** @var string */
    public $name;

    /** @var Database */
    private $db;

    public function __construct(){
        // TODO: move this to a parent Model/Builder class to be available for all created models
        $this->db = Database::getConnection();
    }

    public function init($name, User $user) {
        $this->setName($name);
        $this->user = $user;
    }

    /**
     * Set the name of the document.
     * Performs a validation check too. The name must contain the sub-string `senior`.
     *
     * @throws \Exception if the name provided does not contain the `senior` sub-string inside
     * @throws \InvalidArgumentException if the name provided length is less than 5 characters
     */
    public function setName(string $name): void{
        if(!strpos(strtolower($name), 'senior')) {
            throw new \Exception('The name should contain "senior"');
        }
        if (strlen($name) > 5) {
            throw new \InvalidArgumentException('The name length must be greater than 5 characters');
        }
        $this->name = $name;
    }

    /**
     * Get the name of the document.
     */
    public function getName(): string {
        return $this->name;
    }

    public function getTitle() {
        // here is another solution to improve our code, to assume that another DB layer must return a Database model instead of DB values in array
        // $model = $this->db->getModel()->where('name', '=', $this->name)->first();
        // return $model->title;
        $row = $db->query('SELECT title FROM document WHERE name = "' . $this->name . '" LIMIT 1');

        return $row[0];
    }

    /**
     * This is the old `getAllDocuments` function.
     * Once says `to be implemented later` this indicates, it is not used from anywhere.
     * It is a class, not an interface, we MUST not consider implied that the signature cannot change.
     *
     * So I changed the function name and changed also to accept a User.
     */
    public static function getDocumentsForUser(User $user) {
        // to be implemented later
    }
}

class User {

    /**
     * Makes a document for the user
     */
    public function makeNewDocument($name) {
        $doc = new Document();
        $doc->init($name, $this);
        return $doc;
    }

    public function getMyDocuments() {
        return Document::getDocumentsForUser($this);
    }
}
```
