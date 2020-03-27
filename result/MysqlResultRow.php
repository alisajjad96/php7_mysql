<?php


namespace PHP7MySql\Result;

class MysqlResultRow extends MysqlResult {

    /**
     * @return array All columns in current result row
     */
    public function getAll(){
        return get_object_vars($this);
    }
}
