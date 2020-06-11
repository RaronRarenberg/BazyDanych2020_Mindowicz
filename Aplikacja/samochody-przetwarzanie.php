<?php 
//session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

//laczenie z baza
$link = new mysqli("localhost", "kmindowicz", "xeefae7Ohth7", "kmindowicz_projekt");
$link->query("SET NAMES 'utf8'"); 
if(!$link) die(mysql_error());

$id = 0;
$marka = '';
$model = '';
$vin = '';
$forma_wlasnosci = '';
$osob_dost = '';
$rok_prod = '';
$gasnica = '';
$apteczka_data = '';
$karta_pojazdu = '';
$update = false;

if (isset($_POST['zapisz']))
{
	//mysqli_real_escape_string() chroni przed SQL injection
	$marka = mysqli_real_escape_string($link,$_POST['marka']);
	$model = mysqli_real_escape_string($link,$_POST['model']);
	$vin = mysqli_real_escape_string($link,$_POST['vin']);
	$forma_wlasnosci = mysqli_real_escape_string($link,$_POST['forma_wlasnosci']);
	$osob_dost = mysqli_real_escape_string($link,$_POST['osob_dost']);
	$rok_prod = mysqli_real_escape_string($link,$_POST['rok_prod']);
	$gasnica = mysqli_real_escape_string($link,$_POST['gasnica']);
	$apteczka_data = mysqli_real_escape_string($link,$_POST['apteczka_data']);
	$karta_pojazdu = mysqli_real_escape_string($link,$_POST['karta_pojazdu']);
	
	$link->query("INSERT INTO samochod (marka,model,vin,forma_wlasnosci,osob_dost,rok_prod,gasnica,apteczka_data,karta_pojazdu) VALUES('$marka','$model','$vin','$forma_wlasnosci','$osob_dost','$rok_prod','$gasnica','$apteczka_data','$karta_pojazdu')") or
	die($link->error);
	
	//$_SESSION['message'] = "Wprowadzono pracownika";
	//$_SESSION['msg_type'] = "success";
	
	header("location: samochody.php");
}

if(isset($_GET['delete']))
{
	$id = $_GET['delete'];
	$link->query("DELETE FROM samochod WHERE vin='$id'") or die(mysql_error());
	
	//$_SESSION['message'] = "Wykasowano pracownika";
	//$_SESSION['msg_type'] = "danger";
	
	header("location: samochody.php");
}

if(isset($_GET['edit']))
{
	$id = $_GET['edit'];
	$update = true;
	$wynik = $link->query("SELECT * FROM samochod WHERE vin='$id'") or die(mysql_error());
	if(count($wynik)==1)
	{
		$rzad = $wynik->fetch_array();
		$marka = mysqli_real_escape_string($link,$rzad ['marka']);
		$model = mysqli_real_escape_string($link,$rzad ['model']);
		$vin = mysqli_real_escape_string($link,$rzad ['vin']);
		$forma_wlasnosci = mysqli_real_escape_string($link,$rzad ['forma_wlasnosci']);
		$osob_dost = mysqli_real_escape_string($link,$rzad ['osob_dost']);
		$rok_prod = mysqli_real_escape_string($link,$rzad ['rok_prod']);
		$gasnica = mysqli_real_escape_string($link,$rzad ['gasnica']);
		$apteczka_data = mysqli_real_escape_string($link,$rzad ['apteczka_data']);
		$karta_pojazdu = mysqli_real_escape_string($link,$rzad ['karta_pojazdu']);
		
	}
}

if(isset($_POST['edytuj']))
{
	$marka = mysqli_real_escape_string($link,$_POST['marka']);
	$model = mysqli_real_escape_string($link,$_POST['model']);
	$vin = mysqli_real_escape_string($link,$_POST['vin']);
	$forma_wlasnosci = mysqli_real_escape_string($link,$_POST['forma_wlasnosci']);
	$osob_dost = mysqli_real_escape_string($link,$_POST['osob_dost']);
	$rok_prod = mysqli_real_escape_string($link,$_POST['rok_prod']);
	$gasnica = mysqli_real_escape_string($link,$_POST['gasnica']);
	$apteczka_data = mysqli_real_escape_string($link,$_POST['apteczka_data']);
	$karta_pojazdu = mysqli_real_escape_string($link,$_POST['karta_pojazdu']);
	
	$link->query("UPDATE samochod SET marka='$marka',model='$model',vin='$vin',forma_wlasnosci='$forma_wlasnosci',osob_dost='$osob_dost',rok_prod='$rok_prod',gasnica='$gasnica',apteczka_data='$apteczka_data',karta_pojazdu='$karta_pojazdu' WHERE vin='$vin'") or 
	die(mysql_error());
	
	//$_SESSION['message'] = "Wprowadzono zmiany";
	//$_SESSION['msg_type'] = "warning";
	
	header("location: samochody.php");
}
?>