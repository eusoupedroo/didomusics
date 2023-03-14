<?php
include("includes/includedFiles.php");
?>

<div class="playlistContainer">


    <!-- Header Page  --> 
    <div class="gridViewContainer">
        <h2>Recuperar Playlist</h2>
    </div>

    <!-- Display the playlist of the user  --> 
    <?php
        $username = $userLoggedIn->getUsername();
        $playlistQuery = mysqli_query($con, "SELECT * FROM playlists WHERE owner='$username' AND flag_active = '0' ");

        if(mysqli_num_rows($playlistQuery) == 0){
            echo "<span class='noResults'>Você ainda não possui nenhuma playlist removida </span>";
        }

        while($row = mysqli_fetch_array($playlistQuery)){

            $playlist = new Playlist($con, $row);

            echo 
            "
                <div class='gridViewItem' role='link' tabindex='0' 
							onclick='openPage(\"playlist.php?id=" . $playlist->getId() . "\")'>

                    <div class='playlistImages'>
                        <img src='assets/images/icons/playlist.png'>
                    </div>
                    
                    
                    <div class='gridViewInfo'>"
                        . $playlist->getName() .
                    "</div>
                </div>
            ";
        }
    
    ?>



</div>


