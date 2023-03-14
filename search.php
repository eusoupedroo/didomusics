<?php
include("includes/includedFiles.php");

if(isset($_GET['term'])) {
	$term = urldecode($_GET['term']);
}
else {
	$term = "";
}
?>

<div class="searchContainer">

	<h4>Busque Por Algum Artista, Música ou Album </h4>
	<input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Oque você quer ouvir hoje ?" onfocus="this.value = this.value">

</div>

<script>

$(".searchInput").focus();

$(function() {
	var timer;

	$(".searchInput").keyup(function() {
		clearTimeout(timer);

		timer = setTimeout(function() {
			var val = $(".searchInput").val();
			openPage("search.php?term=" + val);
		}, 2000);

	});


});

</script>

<?php if($term == "" ){exit();} ?>

<!-- Display Music Results Search -->
<div class="tracklistContainer borderBottom">
	<h2>Músicas</h2>
	<ul class="tracklist">		
		<?php

		$termQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '%$term%' LIMIT 15");

        if(mysqli_num_rows($termQuery) == 0){
            echo "<span class='noResults'>Nenhum resultado encontrado para:  " . $term . "</span>";
        }

        $songIdArray = [];
        $i = 1;
        while($row = mysqli_fetch_array($termQuery)){     

			array_push($songIdArray, $row['id']);

			$albumSong = new Song($con, $row['id']);
			$albumArtist = $albumSong->getArtist();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
						<span class='trackNumber'>$i</span>
					</div>


					<div class='trackInfo'>
						<span class='trackName'>" . $albumSong->getTitle() . "</span>
						<span class='nameResult'>" . $albumArtist->getName() . "</span>
					</div>

					<div class='trackOptions'>
						<img class='optionsButton' src='assets/images/icons/more.png'>
					</div>

					<div class='trackDuration'>
						<span class='duration'>" . $albumSong->getDuration() . "</span>
					</div>


				</li>";

			$i = $i + 1;
		}

		?>

		<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
		</script>

	</ul>
</div>

<!-- Display Albums Results Search -->
<div class="gridViewContainer borderBottom">

    <h2>Álbuns</h2>

        <?php
            $albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE title LIKE '%$term%' LIMIT 10 ");

            if(mysqli_num_rows($albumQuery) == 0){
                echo "<span class='noResults'>Nenhum resultado encontrado para:  " . $term . "</span>";
            }


            while($row = mysqli_fetch_array($albumQuery)) {
                $albumObject = new Album($con, $row['id']);

                echo "
                    <div class='searchResultRow' onclick='openPage(\"album.php?id=" . $albumObject->getId() ."\")'>
            
                        <div class='thumbResult'>
                            <img src=" . $albumObject->getartWorkPath() . ">
                        </div>
                        
                        <div class='nameResult'>
                            <span role='link' tabindex='0' >
                                "
                                . $albumObject->getTitle() .
                                "
                            </span>
                        </div>
                    </div>

                    ";
            }
    ?>
</div>




<!-- Display Artist Results Search -->
<div class="gridViewContainer borderBottom">

    <h2>Artistas</h2>

        <?php
            $artistQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '%$term%' LIMIT 10");


            while($row = mysqli_fetch_array($artistQuery)) {
                $artistObject = new Artist($con, $row['id']);

                echo "
                    <div class='searchResultRow' onclick='openPage(\"artist.php?id=" . $artistObject->getId() ."\")'>
            
                        <div class='thumbResult'>
                            <img src=" . $artistObject->getProfilePicture() . ">
                        </div>
                        
                        <div class='nameResult'>
                            <span role='link' tabindex='0' >
                                "
                                . $artistObject->getName() .
                                "
                            </span>
                        </div>
                    </div>

                    ";
            }
        ?>
</div>