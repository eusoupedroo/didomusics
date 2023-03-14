<?php include("includes/includedFiles.php"); 

if(isset($_GET['id'])) {
	$albumId = $_GET['id'];
}
else {
	header("Location: index.php");
}

$album = new Album($con, $albumId);
$albumId = $album->getId();
$artist = $album->getArtist();
$artistId = $artist->getId();
$username = $userLoggedIn->getUsername();
?>

<div class="entityInfo">

	<div class="leftSection">
		<img src="<?php echo $album->getArtworkPath(); ?>">
	</div>

	<div class="rightSection">
		<h2><?php echo $album->getTitle(); ?></h2>
		<p role="link" tabindex="0" onclick="openPage('artist.php?id=<?php echo $artistId; ?>')">Álbum • <?php echo $artist->getName(); ?> • <?php echo $album->getYear(); ?> </p>
		<p>Contém <?php echo $album->getNumberOfSongs(); ?> Músicas • <?php echo $album->getNumbersOfPlays(); ?> Reproduções </p>
		<p><?php echo $album->getDescriptionAlbum(); ?>  </p>

		<?php 
			$query = mysqli_query($con, "SELECT * FROM favorites_albums WHERE albumId='$albumId' AND username='$username'");
			if(!mysqli_num_rows($query) > 0){
				echo "<button class='button' onclick='favoriteAlbum(\"" . $albumId . "\")'>favoritar álbum</button>";
			} 
		?>
	</div>

</div>


<div class="tracklistContainer">
	<ul class="tracklist">
		
		<?php
			$songIdArray = $album->getSongIds();

			$i = 1;
			foreach($songIdArray as $songId) {

				$albumSong = new Song($con, $songId);
				$albumArtist = $albumSong->getArtist();

				echo "<li class='tracklistRow'>
							<div class='trackCount'>
								<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
								<span class='trackNumber'>$i</span>
							</div>


							<div class='trackInfo'>
								<span class='trackName'>" . $albumSong->getTitle() . "</span>
								<span class='artistName'>" . $albumArtist->getName() . "</span>
							</div>

							<div class='trackOptions'>
								<input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
								<img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
							</div>

							<div class='trackDuration'>
								
								
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


<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>