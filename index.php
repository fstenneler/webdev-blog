<?php

error_reporting(E_ALL) ;
session_start();

//chargement des paramètres de configuration
require 'config/config.php';

//chargement automatique des classes instanciées
require('app/ClassAutoloader.php');
app\ClassAutoloader::register();

//routeur
$zone = 'frontend'; //zone par défaut
if(isset($_GET['zone'])) {
    $zone = $_GET['zone'];
}

$page = 'home'; //page par défaut
if($zone === 'backend') {
    $page = 'post';
}

if(isset($_GET['page'])) {
    $page = ucfirst($_GET['page']);
}

if( !file_exists('app/controller/' . $zone . '/' . $page . 'Controller.php') ) { //si le controleur n'existe pas, erreur 404
    $page = 'Error';
}

$app = new app\App($zone, $page); //chargement du controleur
$app->run(); //execution du controleur
