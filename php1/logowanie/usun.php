<?php
  session_start();

  if (!isset($_SESSION['zalogowany']))
  {
	  header('Location: index.php');
	  exit();
  }
  

  require_once "connect.php";
  $conn = @new mysqli($host, $db_user, $db_password, $db_name);
  if ($conn->connect_errno!=0)
  {
    echo "Error: ".$conn->connect_errno;
  }
  else
  {
    $user_id = $_POST["user_id"];
	$checkUser = "SELECT id_wypozyczenia FROM wypozyczenia WHERE id_uzytkownik = $user_id AND data_oddania = 0000-00-00";
	if ($conn->query($checkUser)->num_rows == 1)
	{
		$_SESSION['blad'] = '<span style="color:red">Nie udało się usunąć użytkownika. Użytkownik nie oddał wszystkich książek!</span>';
      	header('Location: uzytkownicy.php');
		$conn->close();
		exit();
	}
	$delete_hist = "DELETE FROM wypozyczenia WHERE id_uzytkownik = $user_id";
	$delete = "DELETE FROM uzytkownicy WHERE id_uzytkownik = $user_id";
	if($conn->query($delete_hist) && $conn->query($delete))
	{
		$_SESSION['success'] = '<span style="color:green">Użytkownik został usunięty!</span>';
		header('Location: uzytkownicy.php');
	}
    $conn->close();
    }
?>