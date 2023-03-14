<?php 
include("includes/includedFiles.php"); 
?>

<h1 class="pageHeadingBig">Álbuns Recomendados</h1>

<div class="gridViewContainer">

	<?php 
	

		$albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 4");

		while($row = mysqli_fetch_array($albumQuery)) {

			echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
						<img src='" . $row['artWorkPath'] . "'>

						<div class='gridViewInfo'>"
							. $row['title'] .
						"</div>
					</span>

				</div>";



		}
	?>


	<h1 class="pageHeadingBig">Artistas Mais Ouvidos</h1>

	<?php
		$artistQuery = mysqli_query($con, "SELECT * FROM artists ORDER BY RAND() LIMIT 4");

		while($row = mysqli_fetch_array($artistQuery)) {

			echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $row['id'] . "\")'>
						<img src='" . $row['profilePicture'] . "'>

						<div class='gridViewInfo'>"
							. $row['name'] .
						"</div>
					</span>

				</div>";
		}
	?>


	<h1 class="pageHeadingBig">Recém Chegados</h1>

	<?php
		$newsQuery = mysqli_query($con, "SELECT * FROM artists ORDER BY id DESC LIMIT 4");

		while($row = mysqli_fetch_array($newsQuery)) {

			echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $row['id'] . "\")'>
						<img src='" . $row['profilePicture'] . "'>

						<div class='gridViewInfo'>"
							. $row['name'] .
						"</div>
					</span>

				</div>";
		}
	?>

</div>