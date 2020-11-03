<?php
echo "program running\n";
class Dao {
    
    private $host = "127.0.0.1";
    private $db = "CraftFiendsWebsite";
    private $user = "root";
    private $pass = "root";

    public function getConnection() {
        try {
            echo "getting connection\n";
            $conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass); 
            return $conn;
        } catch (Exception $e) {
            echo "connection failed:" . print_r($e,1);
            exit();
        }
    }

    public function getAdmin() {
        echo "getting admin\n";
        $conn = $this->getConnection();
        $userQuery = "SELECT * from AdminUser";
        $q = $conn->query($userQuery); 
        foreach ($q as $row) {
            print $row['adminID'] . "\t";
            print $row['adminName'] . "\t";
            print $row['password'] . "\t";
        }
        //$q->execute();
    }
}

$dao = new Dao();
$admin = $dao->getAdmin();
echo print_r($admin, 1);
?>