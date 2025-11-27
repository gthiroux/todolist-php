<?php

namespace Models;

use Exception;
use PDO;

class Database
{
	private static $instance = null;
	protected  $db;

	public function __construct()
	{
		try {
			if (self::$instance == null) {
				self::$instance = new PDO('mysql:host=mysql-con;dbname=database;charset=utf8', 'user', 'password');
			}
			$this->db = self::$instance;
		} catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
	}

	public function __destruct()
	{
		$this->db = NULL;
	}
}
