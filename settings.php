<?php  
include("includes/includedFiles.php");
?>

<div class="entityInfo">

	<div class="centerSection">
		<div class="userInfo">
			<h1><?php echo $userLoggedIn->getFirstAndLastName(); ?></h1>
		</div>

		<div class="gridViewContainer">
			<button class="buttonOutline" onclick="openPage('updateDetails.php')">EDITAR DADOS</button>
			<button class="buttonOutline" onclick="logout()">SAIR DA CONTA</button>
		</div>
	</div>

</div>