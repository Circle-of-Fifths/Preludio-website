<?php
	$server = 'localhost';
	$username = 'root';
	$password = 'preludio';
	$database = 'user_info';

	try {
		$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
	} catch (PDOException $e) {
		die("Connection failed: " . $e->getMessage());
	}
?>