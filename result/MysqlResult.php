<?php

namespace PHP7MySql\Result;

use PHP7MySql\ArrayOrJson;
use PHP7MySql\Base;

class MysqlResult extends Base implements \Serializable {
    use ArrayOrJson;

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1
     */
    public function serialize(){
        return serialize($this->getAll());
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1
     */
    public function unserialize($serialized){
        return unserialize($serialized);
    }

    public function __toString(){
        return $this->toJson();
    }
}
