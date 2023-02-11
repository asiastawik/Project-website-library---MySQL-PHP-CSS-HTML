<?php
  session_start();
  require_once "connect.php";
  $conn = @new mysqli($host, $db_user, $db_password, $db_name);
 
  if ($conn->connect_errno!=0)
  {
    echo "Error: ".$conn->connect_errno;
  }
  else
  {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
	$haslo2 = $_POST['haslo2'];
	
	if ((strlen($login)<3) || (strlen($login)>20) || ctype_alnum($login) == false)
	{
		header('Location: index.php');
		$_SESSION['e_login1']="Login musi posiadać od 3 do 20 znaków i składać się wyłącznie z liter i cyfr!";
	}
	else
	{
		$check_dup = "SELECT * FROM uzytkownicy WHERE login = '$login'";
		if($conn->query($check_dup)->num_rows > 0)
		{
		  header('Location: index.php');
		  $_SESSION['e_login']="Istnieje użytkownik o takim loginie!";
		}
		else
		{
			if($haslo != $haslo2 || (strlen($haslo)<4) || (strlen($haslo)>20))
			{
				header('Location: index.php');
				$_SESSION['e_haslo']="Podane hasła muszą być identyczne i posiadać od 4 do 20 znaków!";
			}   
			
			else
			{
				$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
				
				if(!isset($_POST['regulamin']))
				{
					header('Location: index.php');
					$_SESSION['e_regulamin']="Potwierdź akceptację regulaminu!";
				}          
				else
				{
				  $sql = "INSERT INTO uzytkownicy(login,haslo) VALUES('$login','$haslo_hash')";
				  if($conn->query($sql))
				  {
					header('Location: index.php');
					$_SESSION['rej_done']="Rejestracja przebiegła pomyślnie!";
				  }
				  else
				  {
					$_SESSION['blad'] ="Błąd!";
				  }
				}
			}
		}
		$conn->close();
    }
  }
?>