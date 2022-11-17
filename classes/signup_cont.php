<?php

class SignupCont extends signUp {

    private $uid;
    private $uin;
    private $uiln;
    private $pwd;
    private $pwd2;
    private $email;

    public function __construct($uid,$uin,$uiln,$pwd,$pwd2,$email){
        $this->uid = $uid;
        $this->uin = $uin;
        $this->uiln = $uiln;
        $this->pwd = $pwd;
        $this->pwd2 = $pwd2;
        $this->email = $email;
    }

    public function signupUser(){
        if(!preg_match('/[A-Z]/', $this->pwd) || !preg_match('/\d/', $this->pwd)){
            header("location: ../register?error=PasswordWrong");
            exit();
        }
        if($this->emptyInput() == false){
            header("location: ../register?error=emptyIput");
            exit();
        }
        if($this->EmailCheck() == false){
            header("location: ../register?error=InvalidEmail");
            exit();
        }
        if($this->pwdCheck() == false){
            header("location: ../register?error=PasswordDontMatch");
            exit();
        }
        if($this->uidCheck() == false){
            header("location: ../register?error=UserNameTaken");
            exit();
        }

        $this->setUser($this->uid,$this->uin,$this->uiln, $this->pwd,$this->email);

    }

    public function updateUser(){
        if($this->emptyInput() == false){
            header("location: ../index.php?error=emptyIput");
            exit();
        }
        if($this->EmailCheck() == false){
            header("location: ../index.php?error=InvalidEmail");
            exit();
        }
        if($this->pwdCheck() == false){
            header("location: ../index.php?error=PasswordDontMatch");
            exit();
        }
        $this->upUser($this->uid,$this->uin,$this->uiln, $this->pwd,$this->email);

    }

    

    private function emptyInput(){
        $result;
        if(empty($this->uid) || empty($this->pwd) || empty($this->pwd2) || empty($this->email)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
    private function EmailCheck(){
        $result;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function pwdCheck(){
        $result;
        if($this->pwd !== $this->pwd2)
        {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
    private function uidCheck(){
        $result;
        if(!$this->checkUser($this->uid, $this->email))
        {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
}