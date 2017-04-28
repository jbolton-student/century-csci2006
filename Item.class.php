<?php

class Item {

    private $cost;
    private $description;
    private $name;
    private $image;

    function __construct($name, $cost, $description, $image) {
        $this->cost = $cost;
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
    }

    function getSubTotal() {
        $total = $this->price * $this->qty;
        return $total;
    }

    function __toString() {
        return $this->name . " " . $this->description . " " .
            $this->price . " " . $this->qty . " ". $this->getSubTotal();
    }

}
