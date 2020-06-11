<?php 
//session_start();
ini_set('display_errors', 1);

//laczenie z baza
$link = new mysqli("localhost", "kmindowicz", "xeefae7Ohth7", "kmindowicz_projekt");
$link->query("SET NAMES 'utf8'"); 
if(!$link) die(mysql_error());

$id = 0;
$polisa_waznosc = '';
$firma_ubezp = '';
$vin_aut = '';
$update = false;

if (isset($_POST['zapisz']))
{
	//mysqli_real_escape_string() chroni przed SQL injection
	$polisa_waznosc = mysqli_real_escape_string($link,$_POST['polisa_waznosc']);
	$firma_ubezp = mysqli_real_escape_string($link,$_POST['firma_ubezp']);
	$vin_aut = mysqli_real_escape_string($link,$_POST['vin_aut']);
	
	
	$link->query("INSERT INTO polisa_oc (polisa_waznosc,firma_ubezp,vin_aut) VALUES('$polisa_waznosc','$firma_ubezp','$vin_aut')") or
	die($link->error);
	
	//$_SESSION['message'] = "Wprowadzono pracownika";
	//$_SESSION['msg_type'] = "success";
	
	header("location: polisa_oc.php");
}

if(isset($_GET['delete']))
{
	$id = $_GET['delete'];
	$link->query("DELETE FROM polisa_oc WHERE id_polisy='$id'") or die(mysql_error());
	
	//$_SESSION['message'] = "Wykasowano pracownika";
	//$_SESSION['msg_type'] = "danger";
	
	header("location: polisa_oc.php");
}

if(isset($_GET['edit']))
{
	$id = $_GET['edit'];
	$update = true;
	$wynik = $link->query("SELECT * FROM polisa_oc WHERE id_polisy='$id'") or die(mysql_error());
	if(count($wynik)==1)
	{
		$rzad = $wynik->fetch_array();
		$polisa_waznosc = mysqli_real_escape_string($link,$rzad['polisa_waznosc']);
		$firma_ubezp = mysqli_real_escape_string($link,$rzad['firma_ubezp']);
		$vin_aut = mysqli_real_escape_string($link,$rzad['vin_aut']);
		
	}
}

if(isset($_POST['edytuj']))
{
	$id = mysqli_real_escape_string($link,$_POST['id']);
	$polisa_waznosc = mysqli_real_escape_string($link,$_POST['polisa_waznosc']);
	$firma_ubezp = mysqli_real_escape_string($link,$_POST['firma_ubezp']);
	$vin_aut = mysqli_real_escape_string($link,$_POST['vin_aut']);
		
	$link->query("UPDATE polisa_oc SET polisa_waznosc='$polisa_waznosc',firma_ubezp='$firma_ubezp',vin_aut='$vin_aut' WHERE id_polisy='$id'") or 
	die(mysql_error());
	
	//$_SESSION['message'] = "Wprowadzono zmiany";
	//$_SESSION['msg_type'] = "warning";
	
	header("location: polisa_oc.php");
}
?>