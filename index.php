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
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="assets/styles/stylesheet.css">
</head>
<body>
	<?php if (!empty($user)): ?>
	<h1>Welcome, <?php echo $user['username'] ?></h1>
	<?php else: ?>
	<h1>Project Preludio</h1>
	<?php endif;?>
	<ul>
		<?php if (empty($user)): ?>
		<li><a href = "login.php">Login</a></li>
		<li><a href = "register.php">Registration</a></li>
		<?php else: ?>
		<li><a href = "logout.php">Log out</a></li>
		<li><a href = "scores.php">Scores</a></li>
		<li><left></left></li>
		<?php endif;?>
        <li><a href = "high_scores.php">High Scores</a></li>
		<li><a href = "faq.html">FAQ</a></li>
		<li><a href = "about.html">About</a></li>
		<li><a href = "download.html">Downloads</a></li>
	</ul>
	<img src = "assets/images/circle_of_fifths_colors.png" alt = "Circle of Fifths">
</body>
</html>