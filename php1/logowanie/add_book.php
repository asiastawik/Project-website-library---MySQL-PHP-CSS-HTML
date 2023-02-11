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
    $tytul = $_POST['tytul'];
    $kategoria = $_POST['kategoria'];
    $autor = $_POST['autor'];
    $rok = $_POST['rok'];

	if(strlen($tytul) == 0 || strlen($kategoria) == 0 || strlen($autor) == 0 || strlen($rok) == 0)
	{
		$_SESSION['blad'] = '<span style="color:red">Wszystkie pola muszą zostać wypełnione!</span>';
      	header('Location: dodajKsiazke.php');
		exit();
	}

    $checkBook = "SELECT * FROM ksiazki WHERE tytul = '$tytul'";
    if($conn->query($checkBook)->num_rows > 0)
    {
		$_SESSION['blad'] = '<span style="color:red">Nie dodano książki - istnieje już taka książka!</span>';
      	header('Location: dodajKsiazke.php');
	  
    }
    else
    {
		$checkAutor = "SELECT * FROM autorzy WHERE nazwa = '$autor'";
		if($conn->query($checkAutor)->num_rows == 0)
		{
			$addAutor = "INSERT INTO autorzy(nazwa) VALUES('$autor')";
			$conn->query($addAutor);
		}

		$checkCat = "SELECT * FROM kategorie WHERE nazwa = '$kategoria'";
		if($conn->query($checkCat)->num_rows == 0)
		{
			$addCat = "INSERT INTO kategorie(nazwa) VALUES('$kategoria')";
			$conn->query($addCat);
		}
		$qIdCat = "SELECT id_kategoria FROM kategorie WHERE nazwa = '$kategoria'";
		$rowCat = $conn->query($qIdCat)->fetch_assoc();
		$idCat = $rowCat['id_kategoria'];
		$qIdAut = "SELECT id_autor FROM autorzy WHERE nazwa = '$autor'";
		$rowAut = $conn->query($qIdAut)->fetch_assoc();
		$idAut = $rowAut['id_autor'];
		$addBook = "INSERT INTO ksiazki(tytul,id_kategoria,id_autor,rok_wydania) VALUES('$tytul','$idCat','$idAut','$rok')";
		if($conn->query($addBook))
		{
			$_SESSION['success'] = '<span style="color:green">Książka dodana poprawnie!</span>';
			header('Location: dodajKsiazke.php');
		}
    }
    $rowCat->close();
    $rowAut->close();
    $conn->close();
    }
?>