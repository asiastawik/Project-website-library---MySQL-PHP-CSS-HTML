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
	$book_id = $_POST["book_id"];

	$return = "UPDATE wypozyczenia SET data_oddania = now() WHERE id_ksiazka = $book_id ORDER BY id_wypozyczenia DESC LIMIT 1";
	if($conn->query($return))
	{
		$_SESSION['success'] = '<span style="color:green">Książka została zwrócona!</span>';
		header('Location: wypozyczone.php');
	}
    $conn->close();
    }
?>