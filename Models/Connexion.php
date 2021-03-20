<?php

namespace Models;



class Connexion extends \mysqli
{
    protected $connexion;

    public function __construct(){
        $this->connexion = parent::connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
        return $this->connexion;
    }
}