<html>
	<head>
		<meta charset="utf-8">
		<title>FLOTA SAMOCHODÓW - PRACOWNICY</title>
		<!-- CSS only -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<!-- JS, Popper.js, and jQuery -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php require_once 'przetwarzanie.php';?>
		
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
		
		<div class="row justify-content-center">
		<form action="przetwarzanie.php" method="POST">
		
			<input type="hidden" name="id" value="<?php echo $id; ?>">
		
			<div class="form-group">
			<label>Imię</label>
			<input type="text" name="imie" class="form-control" 
				   value="<?php echo $imie; ?>" placeholder="Wprowadz imie">
			</div>
			
			<div class="form-group">
			<label>Nazwisko</label>
			<input type="text" name="nazwisko" class="form-control" 
				   value="<?php echo $nazwisko; ?>" placeholder="Wprowadz nazwisko">
			</div>
			
			<div class="form-group">
			<label>Numer telefonu</label>
			<input type="text" name="numer" class="form-control" 
				   value="<?php echo $numer; ?>" placeholder="Wprowadz numer telefonu">
			</div>
			
			<div class="form-group">
			<label>E-mail</label>
			<input type="text" name="email" class="form-control" 
				   value="<?php echo $email; ?>" placeholder="Wprowadz e-mail">
			</div>
			
			<div class="form-group">
			<label>Zatrudnienie</label>
			<input type="text" name="zatrudnienie" class="form-control" 
				   value="<?php echo $zatrudnienie; ?>" placeholder="Wprowadz forme zatrudnienia">
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
			
			$tabela = $link->query("SELECT * from pracownik") or die($link->error);
		?>
		<div class="row justify-content-center">
			<table class="table">
				<thead>
					<tr>
						<th>Imię</th>
						<th>Nazwisko</th>
						<th>Numer Telefonu</th>
						<th>E-mail</th>
						<th>Zatrudnienie</th>
						<th colspan="2">Akcja</th><!--to dla przyciskow edytuj oraz usun-->
					</tr>
				</thead>
				<?php
					while($rzad = $tabela->fetch_assoc()):
				?>
				<tr>
					<td><?php echo $rzad['imie']; ?></td>
					<td><?php echo $rzad['nazwisko']; ?></td>
					<td><?php echo $rzad['numer_tel']; ?></td>
					<td><?php echo $rzad['e_mail']; ?></td>
					<td><?php echo $rzad['zatrudnienie']; ?></td>
					<td>
						<a href="pracownicy.php?edit=<?php echo $rzad['e_mail']; ?>"
						   class="btn btn-info">Edytuj</a>
						<a href="pracownicy.php?delete=<?php echo $rzad['e_mail']; ?>"
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
	</body>
	</html>