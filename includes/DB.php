<?php

namespace PHP7MySql;


use PHP7MySql\Result\MysqlResultCollection;

interface DB{
    /**
     * Opens the connections to DB
     *
     * @return bool
     */
    public function openConnection(): bool;
    /**
     * Closes the connections to DB
     *
     * @return bool
     */
    public function closeConnection(): bool;

    /**
     * Executes the given query
     *
     * @param string $query query to perform
     * @param array $values bind values
     * @param string $binds bind string
     * @param bool $openConnection open the connection if not alive
     *
     * @return bool
     */
    public function exec(string $query, $values = [], $binds = '', bool $openConnection = true): bool;

    /**
     * Executes the given query
     *
     * @param string $query query to perform
     * @param array $values values in queries
     * @param string $binds binds of values
     * @param bool $openConnection open the connection if not alive
     *
     * @return MysqlResultCollection|null
     */
    public function fetch(string $query, $values = [], $binds = '', bool $openConnection = true) : ?MysqlResultCollection;
    /**
     * Converts the array to MysqlResultCollection object
     *
     * @param \mysqli_result $result
     * @return MysqlResultCollection
     *
     */
    public function fetchResultAsObject(\mysqli_result $result): MysqlResultCollection;
    /**
     * Checks if connection to DB is open
     *
     * @return bool
     */
    public function isConnectionOpen(): bool;
    /**
     * Returns the DB connection Object
     *
     * @return \mysqli|null
     */
    public function getConnectionObject(): ?\mysqli;
    /**
     * Returns the DB Host
     *
     * @return string
     */
    public function getHost():? string;
    /**
     * Returns the DB Username
     *
     * @return string
     */
    public function getUsername():? string;
    /**
     * Returns the DB Password
     *
     * @return string
     */
    public function getPassword():? string;
    /**
     * Returns the DB Name
     *
     * @return string
     */
    public function getDBName():? string;
    /**
     * Returns the DB Port
     *
     * @return int
     */
    public function getPort():? int;
    /**
     * Returns the DB Socket
     *
     * @return string
     */
    public function getSocket():? string;
}
