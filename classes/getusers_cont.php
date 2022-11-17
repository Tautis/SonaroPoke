<?php

class GetUsersCont extends getusers {
    
    public function showUsers(){

        return $this->getUsers();
    }
    public function showUser($str){
        return $this->getUser($str);
    } 
}