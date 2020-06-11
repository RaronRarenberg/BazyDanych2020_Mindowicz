<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- CSS only -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		
		<title>FLOTA SAMOCHODÓW - SAMOCHODY</title>
		</head>
	<body>
		<?php require_once 'samochody-przetwarzanie.php';?>
		
		<?php
		if(isset($_SESSION['messsage'])): 
		?>
		<div class="alert alert-<?=$_SESSION['msg_type']?>">
		
		<?php 
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		?>
		</div>
		<?php endif ?>
		<a href="index.php" class="btn btn-primary">POWRÓT</a>
		<div class="row justify-content-center">
		<form action="samochody-przetwarzanie.php" method="POST">
		
			<input type="hidden" name="id" value="<?php echo $id; ?>">
		
			<div class="form-group">
			<label>Marka</label>
			<input type="text" name="marka" class="form-control" 
				   value="<?php echo $marka; ?>" placeholder="Wprowadź markę">
			</div>
			
			<div class="form-group">
			<label>Model</label>
			<input type="text" name="model" class="form-control" 
				   value="<?php echo $model; ?>" placeholder="Wprowadź model">
			</div>
			
			<div class="form-group">
			<label>VIN</label>
			<input type="text" name="vin" class="form-control" 
				   value="<?php echo $vin; ?>" placeholder="Wprowadź VIN">
			</div>
			
			<div class="form-group">
			<label>Forma własności</label>
			<input type="text" name="forma_wlasnosci" class="form-control" 
				   value="<?php echo $forma_wlasnosci; ?>" placeholder="Wprowadź formę własności">
			</div>
			
			<div class="form-group">
			<label>Osobowy/Dostawczy</label>
			<input type="text" name="osob_dost" class="form-control" 
				   value="<?php echo $osob_dost; ?>" placeholder="Wprowadź Dostawczy lub Osobowy">
			</div>
			
			<div class="form-group">
			<label>Rok produkcji</label>
			<input type="text" name="rok_prod" class="form-control" 
				   value="<?php echo $rok_prod; ?>" placeholder="Wprowadź rok produkcji">
			</div>
			
			<div class="form-group">
			<label>Gaśnica</label>
			<input type="text" name="gasnica" class="form-control" 
				   value="<?php echo $gasnica; ?>" placeholder="TAK lub zostaw puste pole">
			</div>
			
			<div class="form-group">
			<label>Data ważności apteczki</label>
			<input type="text" name="apteczka_data" class="form-control" 
				   value="<?php echo $apteczka_data; ?>" placeholder="Data w formacie RRRR-MM-DD">
			</div>
			
			<div class="form-group">
			<label>Karta pojazdu</label>
			<input type="text" name="karta_pojazdu" class="form-control" 
				   value="<?php echo $karta_pojazdu; ?>" placeholder="TAK lub zostaw puste pole">
			</div>
			
			<div class="form-group">
			<?php 
			if  ($update == true):
			?>
				<button type="submit" class="btn btn-info" name="edytuj">EDYTUJ</button>
			<?php 
			else:
			?>	
				<button type="submit" class="btn btn-primary" name="zapisz">ZAPISZ</button>
			<?php 
			endif;
			?>
			</div>
		</form>
		</div>
		
		
		
		<div class="container">
		<?php //wyswietlanie tabeli pracownikow
			ini_set('display_errors', 1);
			$link = new mysqli("localhost", "kmindowicz", "xeefae7Ohth7", "kmindowicz_projekt") or 
			die(mysqli_error($link));
			$link->query("SET NAMES 'utf8'"); 
			$link->query("SET CHARACTER SET utf8");  
			$link->query("SET SESSION collation_connection = 'utf8_unicode_ci'");
			
			$tabela = $link->query("SELECT * from samochod") or die($link->error);
			
		?>
		<div class="row justify-content-center">
			<table class="table">
				<thead>
					<tr>
						<th>Marka</th>
						<th>Model</th>
						<th>VIN</th>
						<th>Forma własności</th>
						<th>Osobowy/Dostawczy</th>
						<th>Rok produkcji</th>
						<th>Gaśnica</th>
						<th>Data ważności apteczki</th>
						<th>Karta pojazdu</th>
						<th colspan="2">Akcja</th><!--to dla przyciskow edytuj oraz usun-->
					</tr>
				</thead>
				<?php
					while($rzad = $tabela->fetch_assoc()):
				?>
				<tr>
					<td><?php echo $rzad['marka']; ?></td>
					<td><?php echo $rzad['model']; ?></td>
					<td><?php echo $rzad['vin']; ?></td>
					<td><?php echo $rzad['forma_wlasnosci']; ?></td>
					<td><?php echo $rzad['osob_dost']; ?></td>
					<td><?php echo $rzad['rok_prod']; ?></td>
					<td><?php echo $rzad['gasnica']; ?></td>
					<td><?php echo $rzad['apteczka_data']; ?></td>
					<td><?php echo $rzad['karta_pojazdu']; ?></td>
					<td>
						<a href="samochody.php?edit=<?php echo $rzad['vin']; ?>"
						   class="btn btn-info">Edytuj</a>
						<a href="samochody.php?delete=<?php echo $rzad['vin']; ?>"
						   class="btn btn-danger">Skasuj</a>   
					</td>
				</tr>
				<?php endwhile; ?>

			</table>
		</div>
		<?php
			function wypisz($array)
			{
				echo '<pre>';
				print_r($array);
				echo '</pre>';
			}
		?>
		</div>
		<!-- JS, Popper.js, and jQuery -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	</body>
	</html>