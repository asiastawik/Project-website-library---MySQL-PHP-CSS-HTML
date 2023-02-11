<?php
	session_start();
	
	if (!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }
	if (isset($_SESSION['zalogowany']) && $_SESSION['user_type'] == 'user')
	{
        header('Location: biblioteka.php');
        exit();
    }
	
?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../style.css">
</head>

<body>
	<center><img src="../Logo.png" alt="Polibrary" title="Logo - Polibrary"/></center>
	<h1>Witamy w bibliotece!</h1>
	<div id="nav">
		<a href="../index.php" class="btn">Strona Główna</a>
		<a href="../logowanie/dodajKsiazke.php" class="btn">Dodaj książkę</a>
		<a href="../logowanie/wypozyczone.php" class="btn">Wypożyczenia</a>
		<a href="../logowanie/uzytkownicy.php" class="btn">Użytkownicy</a>
		<a href="../wylogowany/index.php" class="btn">Wyloguj się</a>

		<h2>Dodaj książkę:</h2>
		<form action="add_book.php" method="post">
			Tytuł: <br/><input type="text" name="tytul"/><br/>
			Kategoria: <br/> <input type="text" name="kategoria"><br/>
			Autor: <br/><input type="text" name="autor"><br/>
			Rok wydania: <br/><input type="number" name="rok" max="2022" min="1500"><br/><br/>
			<input type="submit" value="Dodaj książkę">
		</form>
		<?php
			if(isset($_SESSION['blad']))
			{
				echo $_SESSION['blad'];
				unset($_SESSION['blad']);
			}
			if(isset($_SESSION['success']))
			{
				echo $_SESSION['success'];
				unset($_SESSION['success']);
			}
				

		?>
	</div>
</body>
<footer>
		Autorzy: <address>Joanna Stawik & Maciej Siwicki, kurs SCRSK PWR, semestr 7, RiAP
	</address>
		<p>Wszelkie prawa zastrzeżone!</p>
</footer>
</html>