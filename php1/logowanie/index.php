<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../style.css">
</head>

<body>
	<center><img src="../Logo.png" alt="Polibrary" title="Logo - Polibrary"/></center>
	<h1>Witamy w bibliotece!</h1>
	<div id = "nav">
		<a href="../index.php" class="btn">Strona Główna</a>

		<h2>Logowanie do serwisu:</h2>
		<form action="login.php" method="post">
		Login:
		<input type="text" name="login"/>
		<br><br>
		Hasło:
		<input type="password" name="haslo" />
		<br><br>
		<input type="submit" value="Zaloguj" />
		</form>

		<?php
			if(isset($_SESSION['blad']))
				echo $_SESSION['blad'];

		?>

		<h3>Nie masz konta?</h3>
		<a href="../rejestracja/index.php" class="btn">Zarajestruj się</a>
	</div>
</body>
<footer>
		Autorzy: <address>Joanna Stawik & Maciej Siwicki, kurs SCRSK PWR, semestr 7, RiAP
	</address>
		<p>Wszelkie prawa zastrzeżone!</p>
</footer>
</html>