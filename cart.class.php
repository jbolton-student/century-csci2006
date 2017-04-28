<?php
class Cart implements Countable {
    private $items = Array();

    // is the shopping cart empty?
    public function isEmpty() {
        return (empty($this->items));
    }

    // add ShoppingCartItem to cart
    public function addItem($id) {
        // $this->items[$key] = $id;
        array_push($this->items, $id);
    }

    // remove an item from the cart
    public function removeItem($id) {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
        }
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
        // die($this->count());
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
