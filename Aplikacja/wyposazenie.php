<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- CSS only -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		
		<title>FLOTA SAMOCHODÓW - WYPOSAŻENIA</title>
		</head>
	<body>
		<?php require_once 'wyposazenie-przetwarzanie.php';?>
		
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
		<form action="wyposazenie-przetwarzanie.php" method="POST">
		
			<input type="hidden" name="id" value="<?php echo $id; ?>">
		
			<div class="form-group">
			<label>Rodzaj wyposażenia</label>
			<input type="text" name="rodzaj_wypos" class="form-control" 
				   value="<?php echo $rodzaj_wypos; ?>" placeholder="Wprowadź rodzaj wyposażenia">
			</div>
			
			<div class="form-group">
			<label>Opis wyposażenia</label>
			<input type="text" name="opis_wypos" class="form-control" 
				   value="<?php echo $opis_wypos; ?>" placeholder="Wprowadź opis wyposażenia">
			</div>
			
			<div class="form-group">
			<label>VIN</label>
			<input type="text" name="vin_auto" class="form-control" 
				   value="<?php echo $vin_auto; ?>" placeholder="Wprowadź VIN pojazdu">
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
		<?php //wyswietlanie tabeli pobran
			ini_set('display_errors', 1);
			$link = new mysqli("localhost", "kmindowicz", "xeefae7Ohth7", "kmindowicz_projekt") or 
			die(mysqli_error($link));
			$link->query("SET NAMES 'utf8'"); 
			$link->query("SET CHARACTER SET utf8");  
			$link->query("SET SESSION collation_connection = 'utf8_unicode_ci'");
			
			$tabela = $link->query("SELECT * from wyposazenie") or die($link->error);
			
		?>
		<div class="row justify-content-center">
			<table class="table">
				<thead>
					<tr>
						
						<th>Rodzaj wyposażenia</th>
						<th>Opis wyposażenia</th>
						<th>VIN</th>
						<th colspan="2">Akcja</th><!--to dla przyciskow edytuj oraz usun-->
					</tr>
				</thead>
				<?php
					while($rzad = $tabela->fetch_assoc()):
				?>
				<tr>
					
					<td><?php echo $rzad['rodzaj_wypos']; ?></td>
					<td><?php echo $rzad['opis_wypos']; ?></td>
					<td><?php echo $rzad['vin_auto']; ?></td>
					<td>
						<a href="wyposazenie.php?edit=<?php echo $rzad['id_wyposazenia']; ?>"
						   class="btn btn-info">Edytuj</a>
						<a href="wyposazenie.php?delete=<?php echo $rzad['id_wyposazenia']; ?>"
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