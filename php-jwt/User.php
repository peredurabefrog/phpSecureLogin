<?php
    class User{
        private $email;
        private $username;
        private $userId;
        private $password;

        public function setEmail($email)
        {
            $this->email = $email;
        }
        public function getEmail()
        {
            return($this->email);
        }
        public function setUsername($username)
        {
            $this->username = $username;
        }
        public function getUsername()
        {
            return($this->username);
        }
        public function setUserId($userId)
        {
            $this->userId = $userId;
        }
        public function getUserId()
        {
            return($this->userId);
        }
        public function setPassword($password)
        {
            $this->password = $password;
        }
        public function getPassword()
        {
            return($this->password);
        }

        public function toJson()
        {
            return(array("email" => $this->getEmail(), "idUser"=> $this->getUserId(), "nameUser" => $this->getUsername()));
        }
    }
?>
