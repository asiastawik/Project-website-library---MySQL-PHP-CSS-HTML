<?php
	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {
        header('Location: logowanie/biblioteka.php');
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
<html lang="en">
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<meta charset="UFT-8" />
	<meta http-equiv="X-UA Compatibile" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="Description" content="Wypozyczalnia ksiazek, biblioteka, kod na zajecia SDRSK" />
  	<meta name="Keywords" content="biblioteka" />
  	<meta name="Author" content="Joanna Stawik, Maciej Siwicki" />
	<title>Biblioteka</title>
</head>

<body>
	<center><img src="Logo.png" alt="Polibrary" title="Logo - Polibrary"/></center>
	<h1>Witamy w bibliotece!</h1>
	
	<div id = "nav">
		<a href="#" class="btn">Strona Główna</a>
		<a href="logowanie/index.php" class="btn">Zaloguj się</a>
		<a href="rejestracja/index.php" class="btn">Zarajestruj się</a>
			
			<br><br>
			<h2>Wyszukiwarka książek:</h2><br>
			<div class="container px-4 text-center">
				<div class="row gx-5">
					<div class="col">
						<div class="p-3">
							<form action="index.php" method="post">
								<input type="text" class="form-control" name="search_title" placeholder="Tytuł"/><br><button class="btn" type="submit">Wyszukaj</button>
							</form>
						</div>
					</div>
					<div class="col">
						<div class="p-3">
							<form action="index.php" method="post">
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
				if (isset($_POST['search_title']) && strlen($_POST['search_title']) > 0)
				{
					$ksiazka = $_POST['search_title'];
					$sql = "SELECT tytul, kategorie.nazwa AS kategoria, autorzy.nazwa AS autor, rok_wydania FROM ksiazki  INNER JOIN kategorie ON ksiazki.id_kategoria=kategorie.id_kategoria INNER JOIN autorzy ON ksiazki.id_autor=autorzy.id_autor WHERE tytul LIKE '$ksiazka%' ORDER BY tytul;";
				}
				else if (isset($_POST['sort']))
				{
					$sortuj = $_POST['sort'];
					$sql = "SELECT tytul, kategorie.nazwa AS kategoria, autorzy.nazwa AS autor, rok_wydania FROM ksiazki  INNER JOIN kategorie ON ksiazki.id_kategoria=kategorie.id_kategoria INNER JOIN autorzy ON ksiazki.id_autor=autorzy.id_autor ORDER BY $sortuj;";
				}
				else
				{
					$sql = "SELECT tytul, kategorie.nazwa AS kategoria, autorzy.nazwa AS autor, rok_wydania FROM ksiazki  INNER JOIN kategorie ON ksiazki.id_kategoria=kategorie.id_kategoria INNER JOIN autorzy ON ksiazki.id_autor=autorzy.id_autor ORDER BY tytul;";
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
						</tr>
				END;

				if($resultCheck > 0)
				{
					while ($row = $result->fetch_assoc())
					{
						echo '<tr><td>'.$row["tytul"].'</td><td>'.$row["kategoria"].'</td><td>'.$row["autor"].'</td><td>'.$row["rok_wydania"].'<td></tr>';
					}
				}
				else
				{	
					echo'Nie ma książki o takim tytule';

				}

				echo "</table>";
				

			?>
	</div>
</body>
<footer>
	Autorzy: <address>Joanna Stawik & Maciej Siwicki, kurs SCRSK PWR, semestr 7, RiAP</address>
	<p>Wszelkie prawa zastrzeżone!</p>
</footer>

</html>