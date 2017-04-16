<?php
	if (isset($_SESSION['user_id'])) {
		header("Location: /");
	}

	require 'database.php';

	if (!empty($_POST['username']) && !empty($_POST['songname']) && !empty($_POST['score']) && !empty($_POST['rating']) && !empty($_POST['date'])):
		$sql = "INSERT INTO scores (username, song_name, score, rating, date_time) VALUES(:username, :song_name, :score, :rating, :date_time)";
		$stmt = $conn->prepare($sql);

		$stmt->bindParam('username', $_POST['username']);
		$stmt->bindParam('song_name', $_POST['songname']);
		$stmt->bindParam('score', $_POST['score']);
		$stmt->bindParam('rating', $_POST['rating']);
		$stmt->bindParam('date_time', $_POST['date']);

		if ( $stmt->execute() ):
			die('Valid');
		else:
			die('Invalid');
		endif;

	endif;

?>