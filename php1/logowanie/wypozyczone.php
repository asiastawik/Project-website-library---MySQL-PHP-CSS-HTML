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
	require_once "connect.php";
	$conn = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($conn->connect_errno!=0)
	{
		echo "Error: ".$conn->connect_errno;
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
		<div id = "nav">
			<a href="../index.php" class="btn">Strona Główna</a>
			<a href="../logowanie/dodajKsiazke.php" class="btn">Dodaj książkę</a>
			<a href="../logowanie/wypozyczone.php" class="btn">Wypożyczenia</a>
			<a href="../logowanie/uzytkownicy.php" class="btn">Użytkownicy</a>
			<a href="../wylogowany/index.php" class="btn">Wyloguj się</a>
			
			
			<br><br>
			<h2>Wszystkie wypożyczone książki:</h2><br>
			<div class="container px-4 text-center">
				<div class="row gx-5">
					<div class="col">
						<div class="p-3">
							<form action="wypozyczone.php" method="post">
								<input type="text" class="form-control" name="search_title" placeholder="Tytuł"/><br><button class="btn" type="submit">Wyszukaj</button>
							</form>
						</div>
					</div>
					<div class="col">
						<div class="p-3">
							<form action="wypozyczone.php" method="post">
								<select class="form-select" aria-label="Default select example" name="sort">
									<option value="kategoria">Kategoria</option>
									<option value="autor">Autor</option>
								</select>
								<br>
								<button class="btn" type="submit">Sortuj</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<?php
				if(isset($_SESSION['success']))
				{
					echo $_SESSION['success'];
					unset($_SESSION['success']);
				}
				if (isset($_POST['search_title']) && strlen($_POST['search_title']) > 0)
				{
					$ksiazka = $_POST['search_title'];
					$sql = "SELECT ksiazki.id_ksiazka, tytul, kategorie.nazwa AS kategoria, autorzy.nazwa AS autor, rok_wydania, uzytkownicy.login AS uzytkownik FROM wypozyczenia INNER JOIN ksiazki ON wypozyczenia.id_ksiazka= ksiazki.id_ksiazka INNER JOIN uzytkownicy ON wypozyczenia.id_uzytkownik= uzytkownicy.id_uzytkownik INNER JOIN kategorie ON ksiazki.id_kategoria=kategorie.id_kategoria  INNER JOIN autorzy ON ksiazki.id_autor=autorzy.id_autor WHERE tytul LIKE '$ksiazka%' AND data_oddania=0000-00-00 ORDER BY tytul;";
				}
				else if (isset($_POST['sort']))
				{
					$sortuj = $_POST['sort'];
					$sql = "SELECT ksiazki.id_ksiazka, tytul, kategorie.nazwa AS kategoria, autorzy.nazwa AS autor, rok_wydania, uzytkownicy.login AS uzytkownik FROM wypozyczenia INNER JOIN ksiazki ON wypozyczenia.id_ksiazka= ksiazki.id_ksiazka INNER JOIN uzytkownicy ON wypozyczenia.id_uzytkownik= uzytkownicy.id_uzytkownik INNER JOIN kategorie ON ksiazki.id_kategoria=kategorie.id_kategoria  INNER JOIN autorzy ON ksiazki.id_autor=autorzy.id_autor AND data_oddania=0000-00-00 ORDER BY $sortuj;";
				}
				else
				{
					$sql = "SELECT ksiazki.id_ksiazka, tytul, kategorie.nazwa AS kategoria, autorzy.nazwa AS autor, rok_wydania, uzytkownicy.login AS uzytkownik FROM wypozyczenia INNER JOIN ksiazki ON wypozyczenia.id_ksiazka= ksiazki.id_ksiazka INNER JOIN uzytkownicy ON wypozyczenia.id_uzytkownik= uzytkownicy.id_uzytkownik INNER JOIN kategorie ON ksiazki.id_kategoria=kategorie.id_kategoria  INNER JOIN autorzy ON ksiazki.id_autor=autorzy.id_autor AND data_oddania=0000-00-00 ORDER BY tytul;";
				}
				$result = $conn->query($sql);
				$resultCheck = $result->num_rows;
				echo<<<END
					<table class="table">
						<tr>
							<th>Tytuł</th>
							<th>Kategoria</th>
							<th>Autor</th>
							<th>Rok wydania</th>
							<th>Uzytkownik</th>
							<th>Zwróć książkę</th>
						</tr>
				END;

				if($resultCheck > 0)
				{
					while ($row = $result->fetch_assoc())
					{
						$tytul = $row["tytul"];
						$kat = $row["kategoria"];
						$autor = $row["autor"];
						$rok = $row["rok_wydania"];
						$user = $row["uzytkownik"];
						$book_id = $row["id_ksiazka"];
						echo<<<END
						 	<tr>
								<td>$tytul</td>
								<td>$kat</td>
								<td>$autor</td>
								<td>$rok</td>
								<td>$user</td>
								<td>
									<form action="zwroc.php" method=post>								
										<input type="hidden" name="book_id" value=$book_id>
										<button class="btn" type="submit">Zwróć</button>
									</form>
								</td>
							</tr>
						END;
					}

				}
				else
				{	
					echo'Nie ma żadnej wypożyczonej książki.';

				}

				echo "</table>";
				

			?>

		</div>
	</body>
	<footer>
		Autorzy: <address>Joanna Stawik & Maciej Siwicki, kurs SCRSK PWR, semestr 7, RiAP
		</address>
		<p>Wszelkie prawa zastrzeżone!</p>
	</footer>
</html>