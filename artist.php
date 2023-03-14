<?php
include("includes/includedFiles.php");


if(isset($_GET['id'])){
    $artistId = $_GET['id'];
} else {
    header("Location: index.php");
}

// Creating the object Artist
$artist = new Artist($con, $artistId);

// Calling the functions of the class Artist
$artistName =  $artist->getName();
$artistProfilePicture =  $artist->getProfilePicture();

?>

<div class="entityInfo borderBottom">

    <!-- Header Profile Artist -->
    <div class="centerSection">
        <div class="artistInfo">

        <!-- Display the thumb profile  -->
            <div class="artistProfilePicture">
                <img src=" <?php echo $artistProfilePicture; ?>" style="-webkit-mask-image: linear-gradient(to top, transparent 0%, black 50%);">
            </div>
            
            <!-- Display the Artist Name -->
            <div class="artistName">
                <span>Isso é:</span>
                <h1><?php echo $artistName; ?></h1>
            </div>
           

            <!-- Display Play Button  -->
            <div class="headerButtons">
                <button class="button" onclick="playFirstSong()"> Começar  </button>
            </div>
        </div>
    </div>


    <!-- Most Pooular Songs -->
    <div class="tracklistContainer borderBottom">

        <h1 class="mostPopularSongs"> Mais Ouvidos </h1>


        <ul class="tracklist">
            
            <?php
                $songIdArray = $artist->getSongsId();

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


    <!-- Artist Album List -->
    <div class="gridViewContainer">

        <h1>Álbuns </h1>

            <?php
                $albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE artist = '$artistId' ");

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
    </div>
</div>