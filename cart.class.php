<?php

// ensures session instance exists
function initCart() {
    if(!isset($_SESSION['Cart'])) {
        $_SESSION['Cart'] = new Cart();
    }
}

function getCart() {
    return $_SESSION['Cart'];
}

class Cart implements Countable {
        private $items = Array();

        // is the shopping cart empty?
        public function isEmpty() {
            return (empty($this->items));
        }

        public function clear() {
            $this->items = Array();
        }

        // add ShoppingCartItem to cart
        public function addItem($product) {
            // $this->items[$key] = $product;
            array_push($this->items, $product);
        }

        // remove an item from the cart
        public function removeItem($id) {
            foreach ($this->items as $k=>$v) {
                if($v->getID() == $id) {
                    unset($this->items[$k]);
                    break;
                }
            }
            // for($i = 0; $i < $this->count(); $i++) {
            //     if($this->items[$i]->getID() == $id) {
            //         unset($this->items[$i]);
            //         // break;
            //     }
            // }

        }

        // update the quantity of an item in the cart
        // public function updateItem($id, $quantity) {
        //     if (isset($this->items[$id])) {
        //         if ($quantity == 0) {
        //             $this->removeItem($id);
        //         } else {
        //             $item = $this->items[$id];
        //             $item->setQuantity($quantity);
        //             $this->items[$id] = $item;
        //         }
        //     }

        // }

        // return the count of the items in the cart
        public function count() {
            return count($this->items);
        }

        public function getItems() {
            return $this->items;
        }

        // return subtotal of all items in the cart
        public function getSubtotal() {
            $subtotal = 0.0;

            if($this->count() <= 0) {
                return 0.0;
                echo "yeah";
            }
            foreach($this->items as $item) {
                $subtotal += $item->getCost();
            }
            return $subtotal;
        }

        public function __toString() {
            $message = '';
            foreach($this->items as $item) {
                // $message += $item.toString();
                $message += (string)$item;
            }
            return $message;
        }

    function printCart() {
        echo "<h1>cart items:</h1>";
        foreach ($this->items as $item) {
            echo $item->__toString() . "<br>";
        }

        echo "Total: " . $this->getSubtotal() . " <br>";
    }
}

?>
