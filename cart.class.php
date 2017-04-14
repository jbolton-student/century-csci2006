<?php
class Cart implements Countable {
    private $items = Array();

    // is the shopping cart empty?
    public function isEmpty() {
        return (empty($this->items));
    }

    // add ShoppingCartItem to cart
    public function addItem($key, $item) {
        $this->items[$key] = $item;
    }

    // remove an item from the cart
    public function removeItem($key) {
        if (isset($this->items[$key])) {
            unset($this->items[$key]);
        }
    }

    // update the quantity of an item in the cart
    public function updateItem($key, $quantity) {
        if (isset($this->items[$key])) {
            if ($quantity == 0) {
                $this->removeItem($key);
            } else {
                $item = $this->items[$key];
                $item->setQuantity($quantity);
                $this->items[$key] = $item;
            }
        }

    }

    // return the count of the items in the cart
    public function count() {
        return count($this->items);
    }

    public function getItems() {
        return this->items;
    }

    // return subtotal of all items in the cart
    public function getSubtotal() {
        $subtotal = 0.0;
        foreach($this->items as $item) {
            $subtotal += $item->getSubtotal();
        }
        return $subtotal;
    }

    public function __toString() {
        $message = '';
        foreach($this->items as $item) {
            $message += $item.toString();
        }
        return $message;
    }

}

?>
