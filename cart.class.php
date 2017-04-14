<?php
    class Cart {
        private $items = Array();

        // function __construct($name, $cost, $image=NULL, $description=NULL) {
        function __construct() {

        }

        public function getItems() {
            return $this->items;
        }

        public function addItem($key, $item, $amount=1) {
            $this->items[$key] = $item;
        }

        public function updateItem($key, $amount) {
            if($amount == 0) {
                unset($this->items[$key]);
            } else {
                $this->items[$key]["amount"] = $amount;
            }
        }

        public function __toString() {
            return $items.toString();
        }
    }


?>
