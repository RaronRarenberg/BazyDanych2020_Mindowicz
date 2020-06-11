<?php 
//session_start();
ini_set('display_errors', 1);

//laczenie z baza
$link = new mysqli("localhost", "kmindowicz", "xeefae7Ohth7", "kmindowicz_projekt");
$link->query("SET NAMES 'utf8'"); 
if(!$link) die(mysql_error());

$id = 0;
$id_pobrania = '';
$data_pobrania = '';
$data_oddania = '';
$vin_do_auta = '';
$email_pracownika = '';
$update = false;

if (isset($_POST['zapisz']))
{
	//mysqli_real_escape_string() chroni przed SQL injection
	$data_pobrania = mysqli_real_escape_string($link,$_POST['data_pobrania']);
	$data_oddania = mysqli_real_escape_string($link,$_POST['data_oddania']);
	$vin_do_auta = mysqli_real_escape_string($link,$_POST['vin_do_auta']);
	$email_pracownika = mysqli_real_escape_string($link,$_POST['email_pracownika']);
	
	
	$link->query("INSERT INTO pobiera (data_pobrania,data_oddania,vin_do_auta,email_pracownika) VALUES('$data_pobrania','$data_oddania','$vin_do_auta','$email_pracownika')") or
	die($link->error);
	
	//$_SESSION['message'] = "Wprowadzono pracownika";
	//$_SESSION['msg_type'] = "success";
	
	header("location: pobiera.php");
}

if(isset($_GET['delete']))
{
	$id = $_GET['delete'];
	$link->query("DELETE FROM pobiera WHERE id_pobrania='$id'") or die(mysql_error());
	
	//$_SESSION['message'] = "Wykasowano pracownika";
	//$_SESSION['msg_type'] = "danger";
	
	header("location: pobiera.php");
}

if(isset($_GET['edit']))
{
	$id = $_GET['edit'];
	$update = true;
	$wynik = $link->query("SELECT * FROM pobiera WHERE id_pobrania='$id'") or die(mysql_error());
	if(count($wynik)==1)
	{
		$rzad = $wynik->fetch_array();
		$data_pobrania = mysqli_real_escape_string($link,$rzad['data_pobrania']);
		$data_oddania = mysqli_real_escape_string($link,$rzad['data_oddania']);
		$vin_do_auta = mysqli_real_escape_string($link,$rzad['vin_do_auta']);
		$email_pracownika = mysqli_real_escape_string($link,$rzad['email_pracownika']);
		
	}
}

if(isset($_POST['edytuj']))
{
	$id = mysqli_real_escape_string($link,$_POST['id']);
	$id_pobrania = mysqli_real_escape_string($link,$_POST['id_pobrania']);
	$data_pobrania = mysqli_real_escape_string($link,$_POST['data_pobrania']);
	$data_oddania = mysqli_real_escape_string($link,$_POST['data_oddania']);
	$vin_do_auta = mysqli_real_escape_string($link,$_POST['vin_do_auta']);
	$email_pracownika = mysqli_real_escape_string($link,$_POST['email_pracownika']);
		
	$link->query("UPDATE pobiera SET data_pobrania='$data_pobrania',data_oddania='$data_oddania',vin_do_auta='$vin_do_auta',email_pracownika='$email_pracownika' WHERE id_pobrania='$id'") or 
	die(mysql_error());
	
	//$_SESSION['message'] = "Wprowadzono zmiany";
	//$_SESSION['msg_type'] = "warning";
	
	header("location: pobiera.php");
}
?>