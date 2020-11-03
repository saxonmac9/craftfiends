<?php  
    session_start();
    require_once 'Dao.php';
    $dao = new Dao();
    session_unset();
    session_destroy();
    header($dao->getHost());
    exit();
?>