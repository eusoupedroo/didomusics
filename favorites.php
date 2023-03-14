<?php
include("includes/includedFiles.php");
$username = $userLoggedIn->getUsername();
?>

<div class="favoriteContainer">

    <div class="headerSection">
        <h2>Favoritados</h2>
        <span>Aproveite, edite ou curta os álbuns que você favoritou!</span>
    </div>

    <div class="sectionAlbum">
        <h2>Álbuns</h2>

            <div class="gridViewContainer">

                <?php
                    $albumQuery = mysqli_query($con, "SELECT * FROM albums");
                    while($row = mysqli_fetch_array($albumQuery)) {
                        $albumId = $row['id'];
                        $albumObject = new Album($con, $albumId);
                        

                        $favoriteQuery = mysqli_query($con, "SELECT * FROM favorites_albums WHERE albumId='$albumId' AND username='$username'");
                        while($results = mysqli_fetch_array($favoriteQuery)) {
                            echo "
                                <div class='albumSection' role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $albumId . "\")'>

                                    <div class='imageAlbum'>
                                        <img src='" . $albumObject->getartWorkPath() . "'>
                                    </div>
                                        
                                    <div class='informationAlbumSection'>
                                        <h1>". $albumObject->getTitle() ."</h1> 
                                        <p> ".$albumObject->getDescriptionAlbum()." </p>
                                        <button class='buttonOutline'  onclick='desfavoriteAlbum(\"" . $albumId . "\")'> remover dos favoritos </button>
                                    </div>
                                        
                                    
                                </div>";
                        }
                    }
                ?>
            </div>
    </div>





</div>