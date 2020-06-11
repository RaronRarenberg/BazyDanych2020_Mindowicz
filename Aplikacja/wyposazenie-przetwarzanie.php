<?php 
//session_start();
ini_set('display_errors', 1);

//laczenie z baza
$link = new mysqli("localhost", "kmindowicz", "xeefae7Ohth7", "kmindowicz_projekt");
$link->query("SET NAMES 'utf8'"); 
if(!$link) die(mysql_error());

$id = 0;
$rodzaj_wypos = '';
$opis_wypos = '';
$vin_auto = '';
$update = false;

if (isset($_POST['zapisz']))
{
	//mysqli_real_escape_string() chroni przed SQL injection
	$rodzaj_wypos = mysqli_real_escape_string($link,$_POST['rodzaj_wypos']);
	$opis_wypos = mysqli_real_escape_string($link,$_POST['opis_wypos']);
	$vin_auto = mysqli_real_escape_string($link,$_POST['vin_auto']);
	
	
	$link->query("INSERT INTO wyposazenie (rodzaj_wypos,opis_wypos,vin_auto) VALUES('$rodzaj_wypos','$opis_wypos','$vin_auto')") or
	die($link->error);
	
	//$_SESSION['message'] = "Wprowadzono pracownika";
	//$_SESSION['msg_type'] = "success";
	
	header("location: wyposazenie.php");
}

if(isset($_GET['delete']))
{
	$id = $_GET['delete'];
	$link->query("DELETE FROM wyposazenie WHERE id_wyposazenia='$id'") or die(mysql_error());
	
	//$_SESSION['message'] = "Wykasowano pracownika";
	//$_SESSION['msg_type'] = "danger";
	
	header("location: wyposazenie.php");
}

if(isset($_GET['edit']))
{
	$id = $_GET['edit'];
	$update = true;
	$wynik = $link->query("SELECT * FROM wyposazenie WHERE id_wyposazenia='$id'") or die(mysql_error());
	if(count($wynik)==1)
	{
		$rzad = $wynik->fetch_array();
		$rodzaj_wypos = mysqli_real_escape_string($link,$rzad['rodzaj_wypos']);
		$opis_wypos = mysqli_real_escape_string($link,$rzad['opis_wypos']);
		$vin_auto = mysqli_real_escape_string($link,$rzad['vin_auto']);
		
	}
}

if(isset($_POST['edytuj']))
{
	$id = mysqli_real_escape_string($link,$_POST['id']);
	$rodzaj_wypos = mysqli_real_escape_string($link,$_POST['rodzaj_wypos']);
	$opis_wypos = mysqli_real_escape_string($link,$_POST['opis_wypos']);
	$vin_auto = mysqli_real_escape_string($link,$_POST['vin_auto']);
		
	$link->query("UPDATE wyposazenie SET rodzaj_wypos='$rodzaj_wypos',opis_wypos='$opis_wypos',vin_auto='$vin_auto' WHERE id_wyposazenia='$id'") or 
	die(mysql_error());
	
	//$_SESSION['message'] = "Wprowadzono zmiany";
	//$_SESSION['msg_type'] = "warning";
	
	header("location: wyposazenie.php");
}
?>