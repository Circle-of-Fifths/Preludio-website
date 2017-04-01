<?php
	session_start();

	if (isset($_SESSION['user_id'])) {
		header("Location: /");
	}

	require 'database.php';

	$message = '';

	if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])):
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
		<li><a href = "login.php">Login</a></li>
		<li><a href = "register.php">Registration</a></li>
		<li><a href = "scores.php">Score Ranking</a></li>
		<li><a href = "faq.html">FAQ</a></li>
		<li><a href = "about.html">About</a></li>
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