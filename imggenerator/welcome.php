<?php
// Initialize session
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
	header('location: login.php');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Welcome to TextToImg</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
</head>

<body>
	<nav class="navbar navbar-dark bg-dark border border-bottom">
		<div class="container-fluid">
			<a class="navbar-brand">Text2Img</a>
			<div class="d-flex g-3">
				<h6 class="text-white"accordion>Logged user : <b>
						<?php echo $_SESSION['username']; ?>
					</b></h6>
				<a href="logout.php" class="btn btn-block btn-outline-danger">Sign Out</a>
			</div>
		</div>
	</nav>
	<main>
		<section class="welcome container wrapper">
			<div class="page-header">
				<h2 class="display-5">Welcome to Text to Image AI App</h2>

			</div>
			<a href="generate.php" class="btn btn-block btn-outline-success">Generate Page</a>
			<a href="password_reset.php" class="btn btn-block btn-outline-warning">Reset Password</a>
		</section>
	</main>
</body>

</html>