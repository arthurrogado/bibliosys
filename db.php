<?php
    try {
        $conn = new PDO('mysql: host=localhost; dbname=bibliosys', 'root', '');
    } catch (Exception $e) {
        echo $e->getMessage();
        echo "<br>";
        echo $e->getCode();
    }
?>