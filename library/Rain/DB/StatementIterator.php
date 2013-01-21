<?php

// set the namespace
namespace Rain\DB;

/**
 * StatementIterator class iterates the result of the query to save memory
 */
class StatementIterator implements \Iterator
{
    protected $statement, $fetch_mode, $key = 0, $value;
    protected $select_key, $select_value;

    public function __construct(\PDOStatement $statement, $fetch_mode, $key = null, $value = null){
        $this->statement    = $statement;
        $this->select_key   = $key;
        $this->select_value = $value;
        $this->fetch_mode   = $fetch_mode;
    }

    public function rewind(){
        if ($this->statement->execute()) {
            $this->iterate();
        } else {
            $this->value = false;
        }
    }

    public function valid(){
        return (bool) $this->value;
    }

    public function current(){
        return $this->value;
    }

    public function next(){
        $this->iterate();
    }
    
    public function key(){
        return $this->key;
    }
    
    protected function iterate(){

        // The value of the iterator is a selected field of the query
        if( $this->select_value ){
            // save the result field in $this->value
            $field = $this->statement->fetchColumn(0);
            $this->value = $field;
                
        }
        else{
            // save the result row in $this->value
            $row = $this->statement->fetch( $this->fetch_mode );
            $this->value = $row;
        }
        
        if( $this->select_key )
            $this->key = $row[ $this->select_key ];
        else
            $this->key++;

        
    }

}
