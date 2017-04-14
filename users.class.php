<?php
    class User
    {
        private $id;
        private $username;
        private $money;
        private $password;

        function __construct($id, $username, $password, $money)
        {
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->money = $money;
        }


        public function getMoney() {
            return $this->money;
        }

        public function setMoney($money) {
            $this->money = $money;
        }

        public function __toString()
        {
            $bookInfo = $this->bookID . " " . $this->title . " " . $this->author . " " . $this->numOfpages . "  " . $this->price;
            return $bookInfo;

        }
    }


?>
use