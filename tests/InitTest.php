<?php


class InitTest extends PHPUnit\Framework\TestCase {

    public function testInitializeDB(){

        $con = new \mysqli( 'localhost', 'root',
            '' );

        $this->assertTrue($con->query("CREATE DATABASE IF NOT EXISTS `php7_mysql`;"));
        $this->assertTrue($con->select_db('php7_mysql'));

        $this->assertTrue($con->query("
            CREATE TABLE IF NOT EXISTS `test_0` (
                `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                `name` VARCHAR(30) NOT NULL,
                email VARCHAR(50)
            )
        "));

        $this->assertTrue($con->query("
            CREATE TABLE IF NOT EXISTS `test_1`(
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                test_field VARCHAR(30) NOT NULL
            )
        "));

    }

    public function testInit(){

        $db = \PHP7MySql\MySql::init();

        $this->assertInstanceOf(\PHP7MySql\MySql::class, $db);
    }

    public function testConnectionInit(){

        $db = \PHP7MySql\MySql::init(
            'localhost',
            'root',
            '',
            'php7_mysql',
            '',
            3306
        );

        $this->assertTrue($db->openConnection());
    }

    public function testFailedInit(){

        $db = \PHP7MySql\MySql::init(
            'wrong_host',
            'wrong_user',
            '',
            'wrong_db',
            '',
            3306
        );

        $this->assertFalse($db->openConnection());
    }
}
