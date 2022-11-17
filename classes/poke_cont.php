<?php

class PokeCont extends poke {

    private $uid;


    public function __construct($uid){
        $this->uid = $uid;


    }

    public function pokeUser(){
 
        $this->setPoke($this->uid);

    }
    public function pokes(){
        

        return $this->getPokes($this->uid);

    }
    public function pokesS($q,$from, $to){
        

        return $this->getPokesBy($q,$from, $to);

    }

    
}