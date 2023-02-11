<?php
  session_start();
  
   if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
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
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
	
	 $login = htmlentities($login, ENT_QUOTES, "UTF-8");
     
		
    if ($rezultat = @$conn->query(
        sprintf("SELECT * FROM uzytkownicy WHERE login='%s'",
        mysqli_real_escape_string($conn,$login))))
        {
            $ilu_userow = $rezultat->num_rows;
            if($ilu_userow>0)
            {
                $wiersz = $rezultat->fetch_assoc();
                
                if(password_verify($haslo, $wiersz['haslo']))
                {
                  $_SESSION['zalogowany'] = true;
                  $_SESSION['id_uzytkownik'] = $wiersz['id_uzytkownik'];
                  $_SESSION['login'] = $wiersz['login'];
                  $_SESSION['user_type'] = 'user';
                  
                  unset($_SESSION['blad']);
                  $rezultat->free_result();
                  header('Location: biblioteka.php');
                }
                else
                {
                  $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                  header('Location: index.php');
                }
			      }
            else
            {
                $rezultat_admin = @$conn->query(sprintf("SELECT * FROM admini WHERE login='%s'", mysqli_real_escape_string($conn,$login)));
                $ilu_admin = $rezultat_admin->num_rows;
                if($ilu_admin>0)
                {
                  $wiersz = $rezultat_admin->fetch_assoc();
                  
                  if(password_verify($haslo, $wiersz['haslo']))
                  {
                    $_SESSION['zalogowany'] = true;
                    $_SESSION['id_uzytkownik'] = $wiersz['id_uzytkownik'];
                    $_SESSION['login'] = $wiersz['login'];
                    $_SESSION['user_type'] = 'admin';
                    
                    unset($_SESSION['blad']);
                    $rezultat->free_result();
                    header('Location: biblioteka_admin.php');
                  }
                  else
                  {
                    $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                    header('Location: index.php');
                  }
			          }
                else
                {
                  $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                  header('Location: index.php');
                }
            }
            $conn->close();
		    }
  }
?>