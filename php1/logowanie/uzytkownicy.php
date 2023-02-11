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
			<h2>Zarządzaj użytkownikami:</h2><br>
			<div class="container px-4 text-center">
				<div class="row gx-5">
					<div class="col">
						<div class="p-3">
							<form action="uzytkownicy.php" method="post">
								<input type="text" class="form-control" name="username" placeholder="Nazwa użytkownika"/><br><button class="btn" type="submit">Wyszukaj</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			
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
				if (isset($_POST['username']) && strlen($_POST['username']) > 0)
				{
					$username = $_POST['username'];
					$sql = "SELECT id_uzytkownik, login FROM uzytkownicy WHERE login = '$username'";
				}
				else
				{
					$sql = "SELECT id_uzytkownik, login FROM uzytkownicy";
				}
				$result = $conn->query($sql);
				$resultCheck = $result->num_rows;
				echo<<<END
					<table class="table">
						<tr>
							<th>Użytkownik</th>
							<th>Usuń</th>
						</tr>
				END;

				if($resultCheck > 0)
				{
					while ($row = $result->fetch_assoc())
					{
						$login = $row["login"];
						$user_id = $row['id_uzytkownik'];
						echo<<<END
						 	<tr>
								<td>$login</td>
								<td>
									<form action="usun.php" method=post>								
										<input type="hidden" name="user_id" value=$user_id>
										<button class="btn" type="submit">Usuń</button>
									</form>
								</td>
							</tr>
						END;
					}

				}
				else
				{	
					echo'Nie ma uzytkowników.';

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