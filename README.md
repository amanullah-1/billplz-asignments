### Question no - 1: 
Write a password generator which is able to have small, capital letters, numbers, symbols and minimum length. The generator can customize it such as small, capital letters, numbers and minimum length or all above.
```
Symbols: ['!', '#', '$', '%', '&', '(', ')', '*', '+', '@', '^']
```
Print out the password.

### Answer to the question no - 1
#### Here is a password generator program given in php as asked 

```php
<?php
/**
 * How to run the password generator program?
 * cd to /code/directory/billplz-assignment
 * php 1-password-generator.php --length=12 --lowercase=true --uppercase=true --numbers=true --symbols=true
 * customize the options as per your expectation
 */


function generatePassword($length, $useLowerCase = true, $useUpperCase = true, $useNumbers = true, $useSymbols = true) {
    $lowerCaseChars = 'abcdefghijklmnopqrstuvwxyz';
    $upperCaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numberChars = '0123456789';
    $symbolChars = '!#$%&()*+@^';

    $chars = '';
    $password = '';

    if ($useLowerCase) {
        $chars .= $lowerCaseChars;
    }
    if ($useUpperCase) {
        $chars .= $upperCaseChars;
    }
    if ($useNumbers) {
        $chars .= $numberChars;
    }
    if ($useSymbols) {
        $chars .= $symbolChars;
    }

    $charLength = strlen($chars);

    // Check if at least one character type is selected
    if ($charLength === 0) {
        return 'No character type selected.';
    }

    // Generate password
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[rand(0, $charLength - 1)];
    }

    return $password;
}

// Command line argument parsing
$options = getopt('', ['length:', 'lowercase::', 'uppercase::', 'numbers::', 'symbols::']);

$length = isset($options['length']) ? (int)$options['length'] : 8; // Default length to 8
$useLowerCase = isset($options['lowercase']) ? filter_var($options['lowercase'], FILTER_VALIDATE_BOOLEAN) : true;
$useUpperCase = isset($options['uppercase']) ? filter_var($options['uppercase'], FILTER_VALIDATE_BOOLEAN) : true;
$useNumbers = isset($options['numbers']) ? filter_var($options['numbers'], FILTER_VALIDATE_BOOLEAN) : true;
$useSymbols = isset($options['symbols']) ? filter_var($options['symbols'], FILTER_VALIDATE_BOOLEAN) : true;

$password = generatePassword($length, $useLowerCase, $useUpperCase, $useNumbers, $useSymbols);
echo "Generated password: " . $password . PHP_EOL;
```

#### The code block is also given in a file in the same directory `billplz-assignment`  as file name `1-password-generator.php`

  ### How to run the password generator program?
 * cd to /code/directory/billplz-assignment
 * execute command as `php 1-password-generator.php --length=12 --lowercase=true --uppercase=true --numbers=true --symbols=true`
 * customize the options as per your expectation








### Question no - 2
Build a simple automatic pizza ordering program.

    a. Small pizza: RM15
    b. Medium pizza: RM22
    c. Large pizza: RM30
    d. Pepperoni for small pizza: +RM3
    e. Pepperoni for medium pizza: +RM5
    f. Extra cheese for any size pizza: +RM6
Based on an user’s order, work out their final bill.

### Answer to the question no - 2

#### Here is a program for automatic pizza ordering is given in php.

```php
<?php
/**
 * how to run the program
 * cd to /code/directory/billplz-assignment, the run in the command line
 * php 2-automatic-pizza-ordering.php
 */

// Function to calculate the total bill
function calculateBill($pizzaSize, $pepperoni = false, $extraCheese = false) {
    $prices = [
        'small' => 15,
        'medium' => 22,
        'large' => 30
    ];

    $toppingsPrices = [
        'small' => 3,
        'medium' => 5,
        'extra_cheese' => 6
    ];

    $totalPrice = $prices[$pizzaSize];

    // Add pepperoni if selected
    if ($pepperoni) {
        $totalPrice += $toppingsPrices[$pizzaSize];
    }

    // Add extra cheese if selected
    if ($extraCheese) {
        $totalPrice += $toppingsPrices['extra_cheese'];
    }

    return $totalPrice;
}

// Function to prompt user for input and get their response
function prompt($message) {
    echo $message;
    return trim(fgets(STDIN));
}

// User input
$pizzaSize = '';
while (!in_array($pizzaSize, ['small', 'medium', 'large'])) {
    $pizzaSize = prompt("Choose pizza size (small, medium, large): ");
}

$pepperoni = '';
while (!in_array($pepperoni, ['yes', 'no'])) {
    $pepperoni = prompt("Add pepperoni? (yes or no): ");
}
$pepperoni = $pepperoni === 'yes';

$extraCheese = '';
while (!in_array($extraCheese, ['yes', 'no'])) {
    $extraCheese = prompt("Add extra cheese? (yes or no): ");
}
$extraCheese = $extraCheese === 'yes';

// Calculate final bill
$finalBill = calculateBill($pizzaSize, $pepperoni, $extraCheese);
echo "Final bill: RM " . $finalBill . PHP_EOL;
```

#### The code block is also given in a file in the same directory `billplz-assignment`  as file name `2-automatic-pizza-ordering.php`

  ### How to run the password generator program?
 * cd to /code/directory/billplz-assignment
 * execute command as `php 2-automatic-pizza-ordering.php`






### Question no - 3
Users have many credits, each credit has a balance column and created datetime (timezone UTC). Write an SQL statement to retrieve users’ last credit balance on 31st December 2022.

### Answer to the question no - 3
#### Lets we define the `credits` table as 
``` sql
CREATE TABLE credits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    balance DECIMAL(10, 2) NOT NULL,
    created DATETIME NOT NULL
);
```

#### Let's we feed the `credits` table some dummy sample data as 

``` sql
INSERT INTO credits (user_id, balance, created) VALUES
(1, 100.00, '2022-12-30 10:00:00'),
(1, 150.00, '2022-12-31 15:00:00'),
(1, 200.00, '2023-01-01 10:00:00'),
(2, 200.00, '2022-12-28 09:00:00'),
(2, 250.00, '2022-12-31 17:00:00'),
(3, 300.00, '2022-12-31 23:59:00'),
(3, 350.00, '2023-01-01 12:00:00');
```
#### So now SQL Query to Retrieve Last Credit Balance on 31st December 2022 might be like.

```sql 
SELECT c.user_id, c.balance AS last_credit_balance
FROM credits c
INNER JOIN (
    SELECT user_id, MAX(created) AS last_created
    FROM credits
    WHERE created <= '2022-12-31 23:59:59'
    GROUP BY user_id
) AS latest_credit ON c.user_id = latest_credit.user_id AND c.created = latest_credit.last_created;
```

The above query as per the our dummy data response like this: 

user_id | last_credit_balance
--------|--------------------
1       | 150.00
2       | 250.00
3       | 300.00








### Question no - 4
What is the difference between after_save VS after_commit? (Rails)

OR

What is the difference between saved VS afterCommit? (Laravel)

### Answer to the question no - 4
Here as I am a Laravel Developer applicant I answering 

    > What is the difference between saved VS afterCommit? (Laravel)
In Laravel, saved and afterCommit are both events triggered during the lifecycle of a model, but they are fired at different points in the database transaction process.

- saved Event: This event is fired after a model has been successfully saved to the database. It is called regardless of whether the save operation occurred within a transaction or not. This means that if we save a model within a transaction and the transaction is later rolled back, the saved event will still be triggered.

- afterCommit Event: This event is fired after a model has been successfully saved to the database and the database transaction has been committed. This event is specifically triggered only when the transaction has been successfully committed, meaning that if a transaction is rolled back for any reason, the afterCommit event will not be triggered.

In summary, the main difference between saved and afterCommit events lies in their timing relative to the database transaction. saved is triggered regardless of the transaction outcome, while afterCommit is only triggered after the transaction has been successfully committed. This difference is important when we need to perform actions that should only occur after the transaction is guaranteed to be successfully completed.







### Question no - 5
Users’ have many comments and comments can be liked by other users. Write an SQL statement to count how many users liked that comment. 
### Answer to the question no - 5

Lets we define the comments and likes tables as 

```sql
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content TEXT NOT NULL
);

CREATE TABLE likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comment_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (comment_id) REFERENCES comments(id)
);
```
Lets we feed the table with some dummy data as 

```sql
INSERT INTO comments (user_id, content) VALUES
(1, 'This is a comment by user 1'),
(2, 'This is a comment by user 2'),
(3, 'This is a comment by user 3');

INSERT INTO likes (comment_id, user_id) VALUES
(1, 2),
(1, 3),
(2, 1),
(2, 3),
(3, 1);
```

So as per our tables defined the asking SQL statment might be like 
```sql
SELECT c.id AS comment_id, COUNT(l.user_id) AS like_count
FROM comments c
LEFT JOIN likes l ON c.id = l.comment_id
GROUP BY c.id;
```
and as per our given dummy data the SQL statement would return like 

comment_id | like_count
-----------|-----------
1          | 2
2          | 2
3          | 1








### Question no - 6

A snail can climb up 3 meters a day and it will drop 2 meters at night. The well is 11 meters deep. How many days will the snail need to come out from the well and the snail starts climbing in the morning?

### Answer to the question no - 6

To calculate the number of days it will take for the snail to climb out of the well, we can use a simple calculation:

The snail climbs 3 meters during the day.
It drops 2 meters at night.
So, it effectively climbs 1 meter each day (3 meters climbed - 2 meters dropped).

Given that the well is 11 meters deep, and the snail effectively climbs 1 meter each day, we can calculate the number of days needed:

Number of days = Depth of well / Effective climbing rate per day
​
 
Number of days = 11/1 = 11


### So, the snail will need 11 days to climb out of the 11-meter deep well.







