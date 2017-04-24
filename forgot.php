<?php
	session_start();

	if (isset($_SESSION['user_id'])) {
		header("Location: /");
	}

	require 'database.php';
?>

<html>
<head>
	<title>Forgot Password</title>
	<link rel="stylesheet" href="assets/styles/stylesheet.css">
</head>
<body>
	<h1>Forgot Password</h1>

	<?php if(!empty($message)): ?>
		<p> <font color="red"><?= $message ?></font></p>
	<?php endif; ?>

	<ul>
		<li><a href = "login.php">Login</a></li>
		<li><a href = "register.php">Registration</a></li>
		<li><a href = "faq.html">FAQ</a></li>
		<li><a href = "about.html">About</a></li>
	</ul>

	
</body>
</html>