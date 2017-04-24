<?php
	session_start();

	require 'database.php';

	if (isset($_SESSION['user_id'])) {
		$records = $conn->prepare('SELECT id, username, email, password FROM users WHERE id = :id');
		$records->bindParam(':id', $_SESSION['user_id']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);

		$user = NULL;

		if (count($results) > 0) {
			$user = $results;
		}

		$scores = NULL;

		$records = $conn->prepare('SELECT song_name, score, rating, date_time FROM scores WHERE username = :username');
		$records->bindParam(':username', $user['username']);
		$records->execute();
		$results = $records->fetchAll(PDO::FETCH_ASSOC);

		if (count($results) > 0) {
			$scores = $results;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Scores</title>
	<link rel="stylesheet" href="assets/styles/stylesheet.css">
</head>
<body>
	<?php if (!empty($user)): ?>
	<h1><?php echo $user['username'] ?>'s Scores</h1>
	<?php else: ?>
	<h1>Project Preludio</h1>
	<?php endif;?>
	<ul>
		<li><a href = "/">Home</a>
		<?php if (empty($user)): ?>
		<li><a href = "login.php">Login</a></li>
		<li><a href = "register.php">Registration</a></li>
		<?php else: ?>
		<li><a href = "logout.php">Log out</a></li>
		<li><a href = "scores.php">Scores</a></li>
		<li><left></left></li>
		<?php endif;?>
		<li><a href = "faq.html">FAQ</a></li>
		<li><a href = "about.html">About</a></li>
		<li><a href = "download.html">Downloads</a></li>
	</ul>

	<center>
	<div style="margin: 50px 50px 50px 50px">
	<?php if (!empty($scores)): ?>
	<table>
	<tr>
		<th>Song</th>
		<th>Score</th>
		<th>Rating</th>
		<th>Date</th>
	</tr>
		<?php 
			foreach ($results as $row => $link) {
				echo '<tr>';
				echo '<td>'. $link['song_name'] .'</td>';
				echo '<td>'. $link['score'] .'</td>';
				echo '<td>'. $link['rating'] .'</td>';
				echo '<td>'. $link['date_time'] .'</td>';
				echo '</tr>';
			}
		?>
	</table>
	<?php else: ?>
	You don't have any scores. (Yet).
	<?php endif;?>
	</div>
	</center>
</body>
</html>