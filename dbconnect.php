<?php
 try {
    $db = new PDO ('mysql:dbname=memories;host=127.0.0.1;charset=utf8','root', '');
 }catch (PDOException $e) {
     print('DB接続エラー:' . $e->getMessage());
 }
?>