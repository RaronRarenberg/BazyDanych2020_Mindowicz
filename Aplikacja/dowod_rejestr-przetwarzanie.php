<?php 
//session_start();
ini_set('display_errors', 1);

//laczenie z baza
$link = new mysqli("localhost", "kmindowicz", "xeefae7Ohth7", "kmindowicz_projekt");
$link->query("SET NAMES 'utf8'"); 
if(!$link) die(mysql_error());

$id = 0;
$przeglad_waznosc = '';
$numer_rejestr = '';
$auto_vin = '';
$update = false;

if (isset($_POST['zapisz']))
{
	//mysqli_real_escape_string() chroni przed SQL injection
	$przeglad_waznosc = mysqli_real_escape_string($link,$_POST['przeglad_waznosc']);
	$numer_rejestr = mysqli_real_escape_string($link,$_POST['numer_rejestr']);
	$auto_vin = mysqli_real_escape_string($link,$_POST['auto_vin']);
	
	
	$link->query("INSERT INTO dowod_rejestr (przeglad_waznosc,numer_rejestr,auto_vin) VALUES('$przeglad_waznosc','$numer_rejestr','$auto_vin')") or
	die($link->error);
	
	//$_SESSION['message'] = "Wprowadzono pracownika";
	//$_SESSION['msg_type'] = "success";
	
	header("location: dowod_rejestr.php");
}

if(isset($_GET['delete']))
{
	$id = $_GET['delete'];
	$link->query("DELETE FROM dowod_rejestr WHERE id_dowodu='$id'") or die(mysql_error());
	
	//$_SESSION['message'] = "Wykasowano pracownika";
	//$_SESSION['msg_type'] = "danger";
	
	header("location: dowod_rejestr.php");
}

if(isset($_GET['edit']))
{
	$id = $_GET['edit'];
	$update = true;
	$wynik = $link->query("SELECT * FROM dowod_rejestr WHERE id_dowodu='$id'") or die(mysql_error());
	if(count($wynik)==1)
	{
		$rzad = $wynik->fetch_array();
		$przeglad_waznosc = mysqli_real_escape_string($link,$rzad['przeglad_waznosc']);
		$numer_rejestr = mysqli_real_escape_string($link,$rzad['numer_rejestr']);
		$auto_vin = mysqli_real_escape_string($link,$rzad['auto_vin']);
		
	}
}

if(isset($_POST['edytuj']))
{
	$id = mysqli_real_escape_string($link,$_POST['id']);
	$przeglad_waznosc = mysqli_real_escape_string($link,$_POST['przeglad_waznosc']);
	$numer_rejestr = mysqli_real_escape_string($link,$_POST['numer_rejestr']);
	$auto_vin = mysqli_real_escape_string($link,$_POST['auto_vin']);
		
	$link->query("UPDATE dowod_rejestr SET przeglad_waznosc='$przeglad_waznosc',numer_rejestr='$numer_rejestr',auto_vin='$auto_vin' WHERE id_dowodu='$id'") or 
	die(mysql_error());
	
	//$_SESSION['message'] = "Wprowadzono zmiany";
	//$_SESSION['msg_type'] = "warning";
	
	header("location: dowod_rejestr.php");
}
?>