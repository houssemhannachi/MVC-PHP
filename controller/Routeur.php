<?php
require_once('Controller_Produit.php');

//On recupère l'action passée dans l'URL
$action = $_GET['action'];

// Appel de la méthode statique $action de ControllerVoiture
Controller_Produit::$action();
