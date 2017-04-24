<?php
	session_start();

	if (isset($_SESSION['user_id'])) {
		header("Location: /");
	}

	require 'database.php';

	$message = '';

	if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])):
		$records = $conn->prepare('SELECT id, username FROM users WHERE username = :username');
		$records->bindParam(':username', $_POST['username']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);

		if (count($results) > 1) {
			$message = 'Username already exists, try again.';
		} else {
			//sql query
			$sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
			$stmt = $conn->prepare($sql);

			$stmt->bindParam(':username', $_POST['username']);
			$stmt->bindParam(':email', $_POST['email']);
			$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

			if ( $stmt->execute() ):
				$message = 'Successfully created user.';
			else:
				$message = 'Failed creating user.';
			endif;
		}
	endif;
?>

<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" href="assets/styles/stylesheet.css">
</head>
<body>
	<h1>Registration</h1>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<ul>
		<li><a href = "/">Home</a>
		<li><a href = "login.php">Login</a></li>
		<!-- <li><a href = "register.php">Registration</a></li> -->
		<li><a href = "high_scores.php">High Scores</a></li>
		<li><a href = "faq.html">FAQ</a></li>
		<li><a href = "about.html">About</a></li>
		<li><a href = "download.html">Downloads</a></li>
	</ul>

	<form action="register.php" method="POST">
		<input type="text" name="username" placeholder="Username" required>
		<input type="text" name="email" placeholder="E-mail" required>
		<input type="password" name="password" placeholder="Password" required>
		<input type="password" name="confpass" placeholder="Confirm password" required>
		<input type="submit">
	</form>
</body>
</html>