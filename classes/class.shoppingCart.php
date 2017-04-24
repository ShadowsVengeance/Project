<?php

class cart implements iterator {

    private $key;
    protected $items = array();

    public function cart() {

    }

    public function addtocart($isbn, $quantity) {
        array_merge($this->items , [$quantity => $isbn]);
        return 'Success!';
    }
    public function getItems() {
        return $this->items;
    }
    public function rewind()
    {
        reset($this->items);
    }
    public function current()
    {
        $var = current($this->items);
        return $var;
    }
    public function key()
    {
        $var = key($this->items);
        return $var;
    }
    public function next()
    {
        $var = next($this->items);
        return $var;
    }
    public function valid()
    {
        $key = key($this->items);
        $var = ($key !== NULL && $key !== FALSE);
        return $var;
    }

}