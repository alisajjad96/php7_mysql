<?php

namespace PHP7MySql\Result;

class MysqlResultCollection extends MysqlResult implements \Iterator, \Countable {

    /**
     * @var MysqlResultRow[] Result rows
     */
    protected $rows = [];
    /**
     * @var int Current index of row
     */
    protected $index = 0;

    /**
     * MysqlResultCollection constructor.
     *
     * @param MysqlResultRow[] $rows
     */
    public function __construct(array $rows = []){
        $this->rows = $rows;
    }
    /**
     * Adds new row in the list
     *
     * @param MysqlResultRow $row new row to add
     *
     * @return $this
     */
    public function add(MysqlResultRow $row){
        $this->rows[] = $row;
        return $this;
    }

    /**
     * Adds Multiple rows in the list
     *
     * @param MysqlResultRow[] $rows
     *
     * @return $this
     */
    public function addMultiple(array $rows){
        array_push($this->rows, $rows);
        return $this;
    }

    /**
     * Pops the row
     *
     * @return MysqlResultRow|null
     */
    public function pop() :? MysqlResultRow{
        return array_pop($this->rows);
    }

    /** returns rows indexes
     *
     * @return array
     */
    public function keys() : array {
        return array_keys($this->rows);
    }
    /**
     * Reverse the Rows
     *
     * @return MysqlResultCollection
     */
    public function reverse(){
        return new MysqlResultCollection(array_reverse($this->rows));
    }
    /**
     * Returns all rows
     *
     * @return MysqlResultRow[]
     */
    public function values() : array {
        return array_values($this->rows);
    }

    /**
     * Merges the given collection with current collection.
     *
     * @param MysqlResultCollection $toMerge
     * @param bool $atEnd true append given collection at end, false otherwise.
     * @return $this
     */
    public function merge(MysqlResultCollection $toMerge, $atEnd = true){
        if ($atEnd):
            $this->rows = array_merge($this->rows, $toMerge->getAll());
        else:
            $this->rows = array_merge($toMerge->getAll(), $this->rows);
        endif;
        return $this;
    }

    /**
     * Returns all rows
     *
     * @return MysqlResultRow[]
     */
    public function getAll(){
        return $this->rows;
    }

    /**
     * Returns Row Count
     * @return int
     */
    public function getRowsNum() : int {
        return count($this->rows);
    }

    /**
     * Checks if collections is empty.
     * @return bool
     */
    public function isEmpty(){
        return empty($this->rows);
    }

    /**
     * Returns first row from collection
     *
     * @return MysqlResultRow|null
     */
    public function first(){
        return $this->nth(0);
    }

    /**
     * Returns nth index of row
     *
     * @param int $nth
     * @return MysqlResultRow|null
     */
    public function nth(int $nth){
        return $this->rows[$nth] ?? null;
    }

    /**
     * Returns Last row from collection
     * @return MysqlResultRow|null
     */
    public function last(){
        return $this->nth(count($this->rows) -1 );
    }

    /**
     * returns first row or class property via magic method
     * @param $a
     * @return |null
     */
    public function __get($a){
        return !empty($row = $this->first()) ? $row->$a : $this->$a ?? null;
    }

    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0
     */
    public function current(){
        return $this->nth($this->index);
    }

    /**
     * Move forward to next element
     * @link https://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0
     */
    public function next(){
        $this->index++;
    }

    /**
     * Return the key of the current element
     * @link https://php.net/manual/en/iterator.key.php
     * @return string|float|int|bool|null scalar on success, or null on failure.
     * @since 5.0
     */
    public function key(){
        return $this->index;
    }

    /**
     * Checks if current position is valid
     * @link https://php.net/manual/en/iterator.valid.php
     * @return bool The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0
     */
    public function valid(){
        return isset($this->rows[$this->key()]);
    }

    /**
     * Rewind the Iterator to the first element
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0
     */
    public function rewind(){
        $this->index = 0;
    }

    /**
     * Count elements of an object
     * @link https://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1
     */
    public function count(){
        return count($this->rows);
    }
}
