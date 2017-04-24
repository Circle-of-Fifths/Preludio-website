<?php
	session_start();

	require 'database.php';

	$scores = NULL;

	$records = $conn->prepare('SELECT song_name, score, rating, username FROM scores WHERE score in (select max(score) from scores group by song_name)');
	$records->execute();
	$results = $records->fetchAll(PDO::FETCH_ASSOC);

	if (count($results) > 0) {
		$scores = $results;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>High Scores</title>
	<link rel="stylesheet" href="assets/styles/stylesheet.css">
</head>
<body>
	<h1>High Scores</h1>
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
		<th>User</th>
	</tr>
		<?php 
			foreach ($results as $row => $link) {
				echo '<tr>';
				echo '<td>'. $link['song_name'] .'</td>';
				echo '<td>'. $link['score'] .'</td>';
				echo '<td>'. $link['rating'] .'</td>';
				echo '<td>'. $link['username'] .'</td>';
				echo '</tr>';
			}
		?>
	</table>
	<?php else: ?>
	No one played our game :(
	<?php endif;?>
	</div>
	</center>
</body>
</html>
