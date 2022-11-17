<?php

class GetUsers extends Db {

    protected function getUsers(){

        //OLD SELECT s_uid, r_uid,users_name, users_lastname,FROM pokes LEFT JOIN users ON users_uid=r_uid WHERE s_uid = ?; SELECT users_uid, users_email, COUNT(r_uid), poke_date as pokes FROM users LEFT JOIN pokes ON r_uid = users_uid GROUP BY users_uid;
        $stmt = $this->connect()->prepare('SELECT  users_name, users_uid, users_lastname, users_email, COUNT(CASE WHEN s_uid = ? THEN 1 END) as pokes FROM users LEFT JOIN pokes ON r_uid = users_uid GROUP BY users_uid;');


        $name = $_SESSION["useruid"];

        if(!$stmt->execute(array($name))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount()==0)
        {
            $stmt = null;
            header("location: ../index.php/error=NoUsersFounds");
            exit();
        }

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
        return $users;

    }

    protected function getUser($str){
        $stmt = $this->connect()->prepare('SELECT  users_name, users_uid, users_lastname, users_email, COUNT(CASE WHEN s_uid = ? THEN 1 END) as pokes FROM users LEFT JOIN pokes ON r_uid = users_uid WHERE users_name LIKE ? GROUP BY users_uid;');
        $str2 = $str . "%";
        $name = $_SESSION["useruid"];

        if(!$stmt->execute(array($name, $str2))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount()==0)
        {
            $stmt = null;
            header("location: ../index.php/error=NoUsersFounds");
            exit();
        }

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
        return $users;
    }

}