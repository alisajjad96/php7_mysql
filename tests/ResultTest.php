<?php


class ResultTest extends PHPUnit\Framework\TestCase {

    public function testExecutes(){

        $db = \PHP7MySql\MySql::init(
            'localhost',
            'root',
            '',
            'php7_mysql',
            '',
            3306
        );

        $this->assertTrue($db->exec("SHOW TABLES;"));
    }

    public function testFetch(){
        $db = \PHP7MySql\MySql::init(
            'localhost',
            'root',
            '',
            'php7_mysql',
            '',
            3306
        );

        $result = $db->fetch('SHOW TABLES;');

        $this->assertNotNull($result);
    }

    /**
     * @depends testFetch
     */
    public function testResult(){

        $db = \PHP7MySql\MySql::init(
            'localhost',
            'root',
            '',
            'php7_mysql',
            '',
            3306
        );

        $collection = $db->fetch('SHOW TABLES;');

        $this->assertInstanceOf(\PHP7MySql\Result\MysqlResultCollection::class, $collection);

        $this->assertEquals(2, count($collection));

        $reverseCollection = $collection->reverse();

        $this->assertInstanceOf(\PHP7MySql\Result\MysqlResultCollection::class, $reverseCollection);

        $collection->merge($reverseCollection);

        $this->assertEquals(4, count($collection));

        $this->assertInstanceOf(\PHP7MySql\Result\MysqlResultRow::class, $collection->pop());
        $this->assertEquals(3, count($collection));
    }

    /**
     * @depends testResult
     */
    public function testCollection(){
        $db = \PHP7MySql\MySql::init(
            'localhost',
            'root',
            '',
            'php7_mysql',
            '',
            3306
        );

        $result = $db->fetch('SHOW TABLES;');

        $firstRecord = $result->first();
        $lastRecord = $result->last();

        $this->assertInstanceOf(\PHP7MySql\Result\MysqlResultRow::class, $firstRecord);
        $this->assertInstanceOf(\PHP7MySql\Result\MysqlResultRow::class, $lastRecord);

        $this->assertEquals('test_0', $firstRecord->Tables_in_php7_mysql);
        $this->assertEquals('test_1', $lastRecord->Tables_in_php7_mysql);
    }
    /**
     * @afterClass initTest
     */
    public function testDeleteDB(){
        $db = \PHP7MySql\MySql::init(
            'localhost',
            'root',
            '',
            'php7_mysql',
            '',
            3306
        );

        $this->assertTrue($db->exec("DROP DATABASE `php7_mysql`"));
    }
}
