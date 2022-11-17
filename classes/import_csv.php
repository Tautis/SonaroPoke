<?php

$username = "root";
$password = "";
$db = new PDO('mysql:host=localhost;dbname=pokedb',$username,$password);
$stmt = $db ->prepare('CREATE TABLE IF NOT EXISTS users (users_id int NOT NULL AUTO_INCREMENT, users_uid varchar(255) NOT NULL, users_name varchar(255) NOT NULL, users_lastname varchar(255) NOT NULL, users_pwd varchar(255) NOT NULL, users_email varchar(255) NOT NULL, PRIMARY KEY (users_id));');
$stmt ->execute();

$csvFilePath = "imports/users.csv";
$file = fopen($csvFilePath, "rb");
$multiarray = array();
while (($row = fgetcsv($file)) !== FALSE) {


        $stmt = $db->prepare('INSERT INTO users (users_uid, users_name, users_lastname, users_pwd, users_email) VALUES (?,?,?,?,?);');
        
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
        $pwd = substr( str_shuffle( $chars ), 0, 8 );
       
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        $stmt->execute(array($row[0],$row[1],$row[2], $hashedPwd,$row[3]));
            
        }
