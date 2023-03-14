<?php
include("includes/includedFiles.php");
?>

<div class="playlistContainer">
    
    <!-- Header Page  --> 
    <div class="gridViewContainer">
        <h2>Sua Lista De Músicas</h2>
        <button class="buttonOutline" onclick="createPlaylist()">criar</button>
        <button class="buttonOutline" onclick="openPage('retrievePlaylist.php')">recuperar</button>
    </div>

    <!-- Display the playlist of the user  --> 
    <?php
        $username = $userLoggedIn->getUsername();
        $playlistQuery = mysqli_query($con, "SELECT * FROM playlists WHERE owner='$username' AND flag_active = '1' ");

        if(mysqli_num_rows($playlistQuery) == 0){
            echo "<span class='noResults'>Você ainda não possui uma playlist</span>";
        }

        while($row = mysqli_fetch_array($playlistQuery)){

            $playlistObject = new Playlist($con, $row['id']);

            echo 
            "
                    <div class='gridViewItem' role='link' tabindex='0' 
                    onclick='openPage(\"playlist.php?id=" . $playlistObject->getId() . "\")'>

                        <div class='playlistImages'>
                            <img src='assets/images/icons/playlist.png'>
                        </div>
                    
                    
                        <div class='gridViewInfo'>"
                            . $playlistObject->getName() .
                        "</div>
                    </div>
            ";
        }
    
    ?>



</div>


