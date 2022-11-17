<?php

class Signup extends Db {

    protected function setUser($uid,$uin,$uiln,$pwd,$email){
        $stmt = $this->connect()->prepare('INSERT INTO users (users_uid, users_name, users_lastname, users_pwd, users_email) VALUES (?,?,?,?,?);');
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($uid,$uin,$uiln, $hashedPwd,$email))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }

    protected function checkUser($uid,$email){
        $stmt = $this->connect()->prepare('SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?;');

        if(!$stmt->execute(array($uid,$email))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $resultCheck;
        if($stmt->rowCount() > 0){
            $resultCheck = false;

        }
        else{
            $resultCheck = true;
        }
        return $resultCheck;
    }

    protected function upUser($uid,$uin,$uiln,$pwd,$email){
        $stmt = $this->connect()->prepare('UPDATE users SET users_name = ?, users_lastname = ?,users_pwd = ?, users_email = ? WHERE users_uid = ?;');
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($uin,$uiln,$hashedPwd,$email,$uid))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }

}