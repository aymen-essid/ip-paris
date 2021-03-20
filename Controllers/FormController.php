<?php
namespace Controllers;

include_once("Models/User.php");
include_once("Models/Country.php");

use Models\Connexion;
use Models\User;
use Models\Country;


class FormController
{
    protected $db;

    private $user;

    private $country;

    public function __construct(Connexion $connexion)
    {
        $this->db = $connexion;
        $this->user = new User($connexion);
        $this->country = new Country($connexion);
    }

    public function index(){

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            if(isset($_GET['action']) && $_GET['action'] == 'getCountries'){
                $msg = $this->country->getCountries();
                $msg = $this->handleErrors($msg);
                die($msg);
            }

            if($this->user->checkUserFields($_POST) && isset($_GET['action']) && $_GET['action'] == 'addUser'){
                $msg = $this->user->addUser($_POST);
                $msg = $this->handleErrors($msg);
                die($msg);
            }

            if(isset($_GET['action']) && $_GET['action'] == 'getUsers') {
                $msg = $this->user->getUsers();
                $msg = $this->handleErrors($msg);
                die($msg);
            }
        }

        include ("Views/index.html");
    }

    public function handleErrors($msg){
        return json_encode($msg);
    }

}