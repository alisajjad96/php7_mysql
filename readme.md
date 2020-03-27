# php7_mysql

A simple PHP Mysqli Wrapper(prepare statements) with Result collection object which provides basic functionality.

## Requirement
  - PHP 7.2 or higher with mysqli extension
  
## Installation

    composer require alisajjad/php7_mysql
    
## Usage

Initiate the Object:

    $db = \PHP7MySql\MySql::init(
        'host',
        'username',
        'password',
        'php7_mysql',
        'prefix_of_db',
        'port',
        'socket'
    );
    

Execute a simple query:

    $db->exec($sql);

With Parameters:

    $result = $db->exec($sql, [$value1, $value2], 'is')
    
Where `$value1` is first value with bind `i(int)` and `$value2` is second value with `s(string)`.

`$result` is true on success, false on failure.

Fetch Query:

    $result = $db->fetch($sql, [$value1], 'i')
    
`$result` contains MysqlResultCollection object on success, null on failure.

#### MysqlResultCollection

All the query results will be stored in this object.

Common Methods:
  - getAll() - returns all rows in array
  - getRowsNum() - returns rows count
  - isEmpty() - checks if result is empty
  - first() - Returns first row
  - last() - Returns last row
  - nth(int $index) - Returns nth index of row
  - reverse() - Reverses the rows
  - merge(MysqlResultCollection $collection) - Merges given collection with current one.
  
The first row can be directly accessed simply by:

    $result->first_row_column;
or

    $result->first()->first_row_column;
    
Using Loop:

    foreach ($collection as $index => $MySqlResultRow):
        echo $MySqlResultRow->column;
    endforeach;

## Limitation

  - MySql Object doesn't support multi-query yet.
  - No Sorting deep algorithms are applied on collection yet.
