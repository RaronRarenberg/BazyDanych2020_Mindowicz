<?php 
session_start();
ini_set('display_errors', 1);

//laczenie z baza
$link = new mysqli("localhost", "kmindowicz", "xeefae7Ohth7", "kmindowicz_projekt");
$link->query("SET NAMES 'utf8'"); 
if(!$link) die(mysql_error());

$id = 0;
$imie = '';
$nazwisko = '';
$numer = '';
$email = '';
$zatrudnienie = '';
$update = false;

if (isset($_POST['zapisz']))
{
	$imie = $_POST['imie'];
	$nazwisko = $_POST['nazwisko'];
	$numer = $_POST['numer'];
	$email = $_POST['email'];
	$zatrudnienie = $_POST['zatrudnienie'];
	
	$link->query("INSERT INTO pracownik (imie,nazwisko,numer_tel,e_mail,zatrudnienie) VALUES('$imie','$nazwisko','$numer','$email','$zatrudnienie')") or
	die($link->error);
	
	$_SESSION['message'] = "Wprowadzono pracownika";
	$_SESSION['msg_type'] = "success";
	
	header("location: pracownicy.php");
}

if(isset($_GET['delete']))
{
	$id = $_GET['delete'];
	$link->query("DELETE FROM pracownik WHERE e_mail='$id'") or die(mysql_error());
	
	$_SESSION['message'] = "Wykasowano pracownika";
	$_SESSION['msg_type'] = "danger";
	
	header("location: pracownicy.php");
}

if(isset($_GET['edit']))
{
	$id = $_GET['edit'];
	$update = true;
	$wynik = $link->query("SELECT * FROM pracownik WHERE e_mail='$id'") or die(mysql_error());
	if(count($wynik)==1)
	{
		$rzad = $wynik->fetch_array();
		$imie = $rzad['imie'];
		$nazwisko = $rzad['nazwisko'];
		$numer = $rzad['numer_tel'];
		$email = $rzad['e_mail'];
		$zatrudnienie = $rzad['zatrudnienie'];
		
	}
}

if(isset($_POST['edytuj']))
{
	$id = $_POST['id'];
	$imie = $_POST['imie'];
	$nazwisko = $_POST['nazwisko'];
	$numer = $_POST['numer'];
	$email = $_POST['email'];
	$zatrudnienie = $_POST['zatrudnienie'];
	
	$link->query("UPDATE pracownik SET imie='$imie',nazwisko='$nazwisko',numer_tel='$numer',e_mail='$email',zatrudnienie='$zatrudnienie' WHERE e_mail='$email'") or 
	die(mysql_error());
	
	$_SESSION['message'] = "Wprowadzono zmiany";
	$_SESSION['msg_type'] = "warning";
	
	header("location: pracownicy.php");
}
?>