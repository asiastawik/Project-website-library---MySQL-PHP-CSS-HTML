<?php
	session_start();
	
	if (!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }
	if (isset($_SESSION['zalogowany']) && $_SESSION['user_type'] == 'admin')
	{
        header('Location: biblioteka_admin.php');
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
			<a href="../logowanie/moje_ksiazki.php" class="btn">Moje książki</a>
			<a href="../wylogowany/index.php" class="btn">Wyloguj się</a>
			
			
			<br><br>
			<h2>Wypożyczone książki:</h2><br>
			
			<?php
				$user_id = $_SESSION['id_uzytkownik'];
				$sql = "SELECT ksiazki.tytul AS tytul, kategorie.nazwa AS kategoria, autorzy.nazwa AS autor, rok_wydania, data_wypozyczenia FROM wypozyczenia  INNER JOIN ksiazki ON wypozyczenia.id_ksiazka=ksiazki.id_ksiazka INNER JOIN autorzy ON ksiazki.id_autor=autorzy.id_autor INNER JOIN kategorie ON ksiazki.id_kategoria=kategorie.id_kategoria WHERE id_uzytkownik=$user_id AND data_oddania = 0000-00-00 ORDER BY data_wypozyczenia DESC LIMIT 1;";

				$result = $conn->query($sql);
				$resultCheck = $result->num_rows;
				echo<<<END
					<table class="table">
						<tr>
							<th>Tytuł</th>
							<th>Kategoria</th>
							<th>Autor</th>
							<th>Rok wydania</th>
							<th>Data wypożyczenia</th>
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
						$data_wyp = $row["data_wypozyczenia"];
						$user_id = $_SESSION['id_uzytkownik'];
						echo<<<END
						 	<tr>
								<td>$tytul</td>
								<td>$kat</td>
								<td>$autor</td>
								<td>$rok</td>
								<td>$data_wyp</td>
							</tr>
						END;
					}

				}
				else
				{	
					echo'Nie masz aktualnie wypożyczonych książek.';

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