<?php

class Poke extends Db {

    protected function setPoke($uid){
        $stmt = $this->connect()->prepare('INSERT INTO pokes (poke_date, s_uid, r_uid) VALUES (?,?,?);');
        if(!$stmt->execute(array(date("Y-m-d"),$_SESSION["useruid"],$uid))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }


    protected function getPokesBy($q,$from, $to){
        $stmt = $this->connect()->prepare('SELECT s_uid, r_uid, poke_date, users_name FROM pokes LEFT JOIN users ON users_uid=r_uid WHERE s_uid = ? AND poke_date >= ? AND poke_date <= ? AND users_name LIKE ?;');
        $q = $q . "%";


        if(!$stmt->execute(array($_SESSION["useruid"],$from, $to, $q))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $pokes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        
        return $pokes;
    }

    
    protected function getPokes($uid){
        //OLD = SELECT s_uid, r_uid, poke_date FROM pokes WHERE s_uid = ?;
        $stmt = $this->connect()->prepare('SELECT s_uid, r_uid, poke_date,users_name, users_lastname FROM pokes RIGHT JOIN users ON s_uid = users_uid WHERE r_uid = ? ORDER BY users_name desc;');
        $name = $_SESSION["useruid"];
        if(!$stmt->execute(array($name))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }



        $pokes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;

        return $pokes;
    }


}