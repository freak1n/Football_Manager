<?php 
	session_start();
	if (isset($_SESSION['logged']) AND $_SESSION['logged']) 
	{
		header('Location: teams.php');
		die();
	}
	require_once("html-snippets/header-html.php");
?>
<body>
	<div id="page-container">
		<h1>Football Manager</h1>
		<div id="login-form-container">
			<form id="login-form" action="operations/login.php" method="post">
				<input type="text" name="username" placeholder="username" required />
				<input type="password" name="password" placeholder="password" autocomplete="off" required />	
				<input type="submit" name="submit" value="Login" />
				<?php if (isset($_GET['failed']) AND $_GET['failed']==='1') 
				{ 
				?>
				<div id="login-failed-text">Wrong username or password!</div>
				<?php 
				} 
				?>
			</form>
		</div>
	</div>
</body>
</html>
