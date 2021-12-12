<?php
require_once('./model/Model_Produit.php');
require_once('./model/Model_Categorie.php');
class Controller_Produit
{

	public static function getAll()
	{
		$produits = Model_Produit::getAll();
		require('./view/produit_list.php');
	}

	public static function getByCode()
	{
		$code = $_GET['code'];
		$p = Model_Produit::getByCode($code);
		$categories = Model_Categorie::getAll();
		require('./view/produit_MAJ.php');
	}

	public static function FormProcess()
	{
		$p = new Model_Produit($_GET['designation'], $_GET['prix'], $_GET['qte'], $_GET['code_categorie']);
		$categories = Model_Categorie::getAll();
		isset($_GET['code']) ? $status = $p->save($_GET['code']) : $status = $p->save();
		if ($status) {
			self::getAll();
		} else {
			$message = 'duppCode';
			require('./view/error.php');
		}
	}

	public static function save()
	{
		$categories = Model_Categorie::getAll();
		require('./view/produit_ajout.php');
	}
	public static function delete()
	{
		$code = $_GET['code'];
		Model_Produit::delete($code);
		self::getAll();
	}
}
