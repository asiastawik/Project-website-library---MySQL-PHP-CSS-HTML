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
	$book_id = $_POST["book_id"];
	$checkBook = "SELECT id_wypozyczenia FROM wypozyczenia WHERE id_ksiazka = $book_id AND data_oddania = 0000-00-00";
	$checkUser = "SELECT id_wypozyczenia FROM wypozyczenia WHERE id_uzytkownik = $user_id AND data_oddania = 0000-00-00";
	if ($conn->query($checkBook)->num_rows == 1)
	{
		$_SESSION['blad'] = '<span style="color:red">Nie udało się wypożyczyć książki. Książka jest już wypożyczona.</span>';
      	header('Location: biblioteka.php');
		$conn->close();
		exit();
	}
	if ($conn->query($checkUser)->num_rows == 1)
	{
		$_SESSION['blad'] = '<span style="color:red">Nie udało się wypożyczyć książki. Możesz mieć wypożyczoną tylko jedną książkę!</span>';
      	header('Location: biblioteka.php');
		$conn->close();
		exit();
	}
	$borrow = "INSERT INTO wypozyczenia(id_uzytkownik ,id_ksiazka, data_wypozyczenia) VALUES('$user_id','$book_id', now())";
	if($conn->query($borrow))
	{
		$_SESSION['success'] = '<span style="color:green">Książka została wypożyczona!</span>';
		header('Location: biblioteka.php');
	}
    $conn->close();
    }
?>