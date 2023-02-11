<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../style.css">
	<meta charset="UFT-8" />
	<meta http-equiv="X-UA Compatibile" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="Description" content="Wypozyczalnia ksiazek, biblioteka, kod na zajecia SDRSK" />
  	<meta name="Keywords" content="biblioteka" />
  	<meta name="Author" content="Joanna Stawik, Maciej Siwicki" />
</head>

<body>
<center><img src="../Logo.png" alt="Polibrary" title="Logo - Polibrary"/></center>
<h1>Witamy w bibliotece!</h1>
<div id = "nav">
	<a href="../index.php" class="btn">Strona Główna</a>
	<a href="../logowanie/index.php" class="btn">Zaloguj się</a>
	<a href="../rejestracja/index.php" class="btn">Zarajestruj się</a>

	<?php
	
		session_start();
		session_unset();
	
	?>

	<h2>Zostałeś poprawnie wylogowany z serwisu.</h2>
	<a href="../index.php">Powrót na stronę główną.</a>
</div>
</body>
<footer>
		Autorzy: <address>Joanna Stawik & Maciej Siwicki, kurs SCRSK PWR, semestr 7, RiAP
	</address>
		<p>Wszelkie prawa zastrzeżone!</p>
</footer>
</html>