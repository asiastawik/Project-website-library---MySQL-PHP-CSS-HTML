<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../style.css">
  <style>
  .error
  {
	  color:red;
	  margin-top: 10px;
	  margin-bottom: 10 px;
  }
  
    .done
  {
	  color:blue;
	  margin-top: 10px;
	  margin-bottom: 10 px;
  }
  </style>
</head>

<body>
<center><img src="../Logo.png" alt="Polibrary" title="Logo - Polibrary"/></center>
<h1>Witamy w bibliotece!</h1>
<div id = "nav">
	<a href="../index.php" class="btn">Strona Główna</a>

	<h2>Rejestracja:</h2>
	<form action="register.php" method="post">
		Login: <br/><input type="text" name="login"/> <br/>
		Hasło: <br/><input type="password" name="haslo"/> <br/>
		Powtórz hasło: <br/><input type="password" name="haslo2"/> <br/>
		<label>
			<input type="checkbox" name="regulamin" /> Akceptuję <a href="regulamin.html">regulamin</a>.
		</label>
		<br><br>

		<input type="submit" value="Stwórz użytkownika"/> 
		
	</form>

	<?php
		if(isset($_SESSION['e_login1']))
			echo'<div class="error">'.$_SESSION['e_login1'].'</div>';
			unset($_SESSION['e_login1']);
			
		if(isset($_SESSION['e_login']))
			echo'<div class="error">'.$_SESSION['e_login'].'</div>';
			unset($_SESSION['e_login']);
		
		if(isset($_SESSION['blad']))
			echo'<div class="error">'.$_SESSION['blad'].'</div>';
			unset($_SESSION['blad']);
			
		if(isset($_SESSION['e_haslo']))
			echo'<div class="error">'.$_SESSION['e_haslo'].'</div>';
			unset($_SESSION['e_haslo']);
			
		if(isset($_SESSION['e_regulamin']))
			echo'<div class="error">'.$_SESSION['e_regulamin'].'</div>';
			unset($_SESSION['e_regulamin']);
			
		if(isset($_SESSION['rej_done']))
			echo'<div class="done">'.$_SESSION['rej_done'].'</div>';
			unset($_SESSION['rej_done']);
	?>

	<h3>Masz już konto?</h3>
	<a href="../logowanie/index.php" class="btn">Zaloguj się</a>
</div>
</body>
<footer>
		Autorzy: <address>Joanna Stawik & Maciej Siwicki, kurs SCRSK PWR, semestr 7, RiAP
	</address>
		<p>Wszelkie prawa zastrzeżone!</p>
</footer>
</html>