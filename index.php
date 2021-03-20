<?php

include_once ("conf.php");
include_once ("Models/Connexion.php");
include_once ("Controllers/FormController.php");


$connexion = new \Models\Connexion();
$start = new Controllers\FormController($connexion);
$start->index();