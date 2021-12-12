<?php
require_once('Database.php');

class Model_Produit
{
	private $data = array();

	public function __construct($designation = null, $prix = null, $qte = null, $code_categorie = null)
	{
		if (!is_null($designation) && !is_null($prix) && !is_null($qte) && !is_null($code_categorie)) {
			$this->data['designation'] = $designation;
			$this->data['prix'] = $prix;
			$this->data['qte'] = $qte;
			$this->data['code_categorie'] = $code_categorie;
		}
	}

	public function __get($attr)
	{
		if (!isset($this->data[$attr]))
			return "erreur";
		else return ($this->data[$attr]);
	}

	public function __set($attr, $value)
	{
		$this->data[$attr] = $value;
	}

	public function save($code = null)
	{
		try {
			$db = new Database();
			if ($code == null) {
				$db->execute_query("INSERT INTO produit(designation,prix,qte,code_categorie) VALUES (:designation,:prix,:qte,:code_categorie)", $this->data);
			} else {
				$db->execute_query("UPDATE produit SET designation = :designation, prix = :prix, qte = :qte, code_categorie = :code_categorie WHERE codepr='$code'", $this->data);
			}
		} catch (PDOException $e) {
			echo "Echec de la connexion: " . $e->getMessage();
			return false;
		}
		return true;
	}

	public static function getAll()
	{
		$db = new Database();
		$sql = "SELECT * from produit LEFT JOIN categorie ON produit.code_categorie = categorie.code";
		$resultat = $db->execute_query($sql);
		if (!$resultat) {
			$erreur = $db->getPDO()->errorInfo();
			echo "Lecture impossible, code", $db->getPDO()->errorCode(), $erreur[2];
		} else {
			return $resultat->fetchAll(PDO::FETCH_OBJ);
		}
	}
	public static function getByCode($code)
	{
		$db = new Database();
		$sql = "SELECT * FROM produit WHERE codepr=?";
		$params = [$code];

		$resultat = $db->execute_query($sql, $params);
		if (!$resultat) {
			$erreur = $db->getPDO()->errorInfo();
			echo "Lecture impossible, code", $db->getPDO()->errorCode(), $erreur[2];
		} else {
			return $resultat->fetch(PDO::FETCH_OBJ);
		}
	}
	public static function delete($code)
	{
		$db = new Database();
		$db->execute_query("DELETE FROM produit WHERE codepr=?", [$code]);
	}
}
