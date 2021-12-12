<?php

class Database
{
	private static $pdo;

	public function __construct($hostname = 'localhost', $database = 'magasin', $user = 'root', $pass = '')
	{
		$dsn = "mysql:host=" . $hostname . "; dbname=" . $database;
		if (is_null(self::$pdo)) {
			try {
				self::$pdo = new PDO($dsn, $user, $pass);
				// set the PDO error mode to exception
				self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $except) {
				echo "Echec de la connexion: " . $except->getMessage();
				die();
			}
		}
	}

	public function getPDO()
	{
		return self::$pdo;
	}

	public function execute_query($sql, $params = null)
	{
		if ($params == null) {
			$resultat = self::$pdo->query($sql); // exécution directe
		} else {
			$resultat = self::$pdo->prepare($sql);  // requête préparée
			$resultat->execute($params);
		}
		if (!$resultat) {
			$erreur = self::$pdo->errorInfo();
			echo "Lecture impossible, code", $this->pdo->errorCode(), $erreur[2];
			die();
		} else {

			//return $resultat->fetchAll(PDO::FETCH_OBJ);
			return $resultat;
		}
	}
}
// $db = new Database('localhost', 'magasin', 'root', '');
// var_dump($db->execute_query('SELECT * FROM produit'));
