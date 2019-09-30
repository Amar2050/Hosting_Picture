<?php
	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
		
		// checking size 
		if ($_FILES['image']['size'] <= 3000000) {
			// Checking Extension
			$informationsImage =  pathinfo($_FILES['image']['name']);
			$extensionImage = $informationsImage['extension'];
			$extensionsArray = array('jpg', 'png', 'jpeg', 'gif');

			if (in_array($extensionImage, $extensionsArray)) {

				$uniqueFileName = time().rand().rand().basename($_FILES['image']['name']);
				$location = 'uploads/';

				move_uploaded_file($_FILES['image']['tmp_name'], $location.$uniqueFileName);
				$imageLocation = $location.$uniqueFileName;
				$imageSuccess = "	<div class='alert alert-success text-center my-5'>
							<h4 class='alert alert-heading'>
								Votre image as bien été envoyez !
							</h4>
							<img src='$imageLocation' class='img-fluid border rounded' alt='image $uniqueFileName'>
							<br>
							<input type='text' value='http://localhost/picture_host/$imageLocation'/>
							<br>
							<a href='http://localhost/picture_host/$imageLocation' target='_blank'>Voir mon image</a>
							
						</div>";
			} 
		} 
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="https://bootswatch.com/4/materia/bootstrap.min.css">
	<title>Hébergeur d'image</title>
</head>
<body>
	<!-- Header -->
	<header>
		<h1 class="text-center text-white my-5 alert alert-primary">
			<i class="fas fa-arrow-up"></i>
			PictureUpload
			<i class="fas fa-arrow-up"></i>
		</h1>
	</header>

	<div class="container">
		<div class="bg-light text-center">
		<h2 class="my-5">Envoyez votre photo</h2>
			<form method="post" action="index.php" enctype="multipart/form-data">
				<input type="file" name="image" id="" required>
				<button type="submit">Envoyer</button>
			</form>
		</div>
		<img src="" class="img-fluid" alt="">
		<?php
			if (isset($imageSuccess)) {
				echo $imageSuccess ;
			}else {
				echo "	<div class='alert alert-danger text-center my-5'>
							<h4 class='alert alert-heading'>
								<i class='fas fa-exclamation-triangle fa-3x'></i><br>
								Erreur lors de l'envoi <br>
								Format ou taille incorrecte
							</h4>
						</div>";			
			}
		?>

	</div>

</body>
</html>