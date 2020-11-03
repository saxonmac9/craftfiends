<?php
class User {

    public $userName;
    public $password;
    public $email;
    protected $permission;

    public function __construct($userName, $password, $email) {
        $this->userName = $userName;
        $this->password = $password;
        $this->email = $email;
        $this->permission = array();
    }
}
?>