<?php
	session_start();

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
			$_SESSION['user_id'] = $results['id'];
			header("Location: /");
		} else {
			$message = 'Those credentials don\'t match or they don\'t exist.';
		}
	endif;

?>

<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="assets/styles/stylesheet.css">
</head>
<body>
	<h1>Login</h1>

	<?php if(!empty($message)): ?>
		<p> <font color="red"><?= $message ?></font></p>
	<?php endif; ?>

	<ul>
		<li><a href = "/">Home</a>
		<!-- <li><a href = "login.php">Login</a></li> -->
		<li><a href = "register.php">Registration</a></li>
		<li><a href = "high_scores.php">High Scores</a></li>
		<li><a href = "faq.html">FAQ</a></li>
		<li><a href = "about.html">About</a></li>
		<li><a href = "download.html">Downloads</a></li>
	</ul>

	<form action="login.php" method="POST">
		<input type="text" name="username" placeholder="Username" required>
		<input type="password" name="password" placeholder="Password" required>
		<input type="submit">
	</form>
    <!-- <center><a href="forgot.php">Forgot Password?</a></center> -->
</body>
</html>