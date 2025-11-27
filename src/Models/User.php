<?php

namespace Models;

use Exception;
use PDO;

class User extends Database
{
	private $id;
	private $firstname;
	private $lastname;
	private $email;
	private $password;

	public function getFirstname()
	{
		return $this->firstname;
	}

	public function setFirstname($value)
	{
		if (empty($value)) throw new Exception('Firstname is required');
		if (strlen($value) < 3 && strlen($value) > 50) throw new Exception('Firstname must be between 3 and 50 characters');
		if (!preg_match('/^[a-zA-Z0-9]+$/', $value)) throw new Exception('Firstname can only contain letters and numbers');

		$this->firstname = htmlspecialchars($value);
	}
	public function getLastname()
	{
		return $this->lastname;
	}

	public function setLastname($value)
	{
		if (empty($value)) throw new Exception('Lastname is required');
		if (strlen($value) < 3 && strlen($value) > 50) throw new Exception('Lastname must be between 3 and 50 characters');
		if (!preg_match('/^[a-zA-Z0-9]+$/', $value)) throw new Exception('Lastname can only contain letters and numbers');

		$this->lastname = htmlspecialchars($value);
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($value)
	{
		if (empty($value))	throw new Exception('Email is required');
		if (!filter_var($value, FILTER_VALIDATE_EMAIL)) throw new Exception('Invalid email address');

		$this->email = htmlspecialchars($value);
	}

	public function setPassword($value)
	{
		if (empty($value)) throw new Exception('Password is required');
		if (strlen($value) > 3) throw new Exception('Password must be at least 3 characters');

		$this->password = password_hash($value, PASSWORD_DEFAULT);
	}

	public function getPassword()
	{
		return $this->password;
	}
	public function checkConfirmPassword($value)
	{
		if (empty($value) || empty($this->password)) throw new Exception('Le mot de passe et la confirmation de mot de passe est obligatoire');
		if (password_verify($value, $this->password)) throw new Exception('La confirmation de mot de passe ne correspond pas');
		return true;
	}
	public function getUserByEmail()
	{
		$queryExecute = $this->db->prepare("SELECT * FROM users WHERE `email` = :email");
		$queryExecute->bindValue(':email', $this->email, PDO::PARAM_STR);

		$queryExecute->execute();
		return $queryExecute->fetch(PDO::FETCH_OBJ);
	}
	public function createUser()
	{
		if ($this->getUserByEmail()) throw new Exception('Email déjà utilisé');

		$queryExecute = $this->db->prepare("INSERT INTO `users`(`firstname`,`lastname`, `email`, `password`) 
			VALUES (:firstname,:lastname, :email, :password)");

		$queryExecute->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
		$queryExecute->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
		$queryExecute->bindValue(':email', $this->email, PDO::PARAM_STR);
		$queryExecute->bindValue(':password', $this->password, PDO::PARAM_STR);

		return $queryExecute->execute();
	}

	public function getUser($id)
	{

		$sql = "SELECT * FROM users WHERE `id` :id";
		$queryExecute = $this->db->prepare($sql);
		$queryExecute->bindValue(':id', $id, PDO::PARAM_INT);

		$queryExecute->execute();
		return $queryExecute->fetch(PDO::FETCH_OBJ);
	}

	public function modifUser($id)
	{
		$queryExecute = $this->db->prepare("UPDATE `users` 
			SET `firstname`=:firstname,`lastname`=:lastname, `email`=:email, `password`=:password 
			WHERE `id`=:id");

		$queryExecute->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
		$queryExecute->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
		$queryExecute->bindValue(':email', $this->email, PDO::PARAM_STR);
		$queryExecute->bindValue(':password', $this->password, PDO::PARAM_STR);
		$queryExecute->bindValue(':id', $id, PDO::PARAM_INT);

		return $queryExecute->execute();
	}
	public function deleteUser($id)
	{
		$queryExecute = $this->db->prepare("DELETE FROM `users` WHERE `id`=:id");
		$queryExecute->bindValue(':id', $id, PDO::PARAM_INT);

		return $queryExecute->execute();
	}
}
