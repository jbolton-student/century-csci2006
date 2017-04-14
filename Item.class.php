<?php

class Item {

    private $name;
    private $description;
    private $price;
    private $qty;

    function __construct($n, $d, $p, $q) {
        $this->name = $n;
        $this->description = $d;
        $this->price = $p;
        $this->qty = $q;
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
