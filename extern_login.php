<?php
	if (isset($_SESSION['user_id'])) {
		header("Location: /");
	}

	require 'database.php';

	if (!empty($_POST['username']) && !empty($_POST['password'])):
		$records = $conn->prepare('SELECT id, username, password FROM users WHERE username = :username');
		$records->bindParam(':username', $_POST['username']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);

		$message = '';

		if (count($results) > 0 && password_verify($_POST['password'], $results['password']) ) {
			die('Valid');
		} else {
			die('Invalid');
		}
	endif;

?>