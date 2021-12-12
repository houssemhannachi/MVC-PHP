<?php
//l'utilisateur souhaite affichier la liste des produits en cliquant sur index.php
if (!isset($_GET['action']) ) {
    $_GET['action'] = "getAll";
}
require('controller/Routeur.php');
