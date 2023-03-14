<?php
include("includes/includedFiles.php");
?>

<div class="userDetails">

	<div class="container borderBottom">
		<h2>E-MAIL</h2>
		<input type="text" class="email" name="email" placeholder="E-mail" value="<?php echo $userLoggedIn->getEmail(); ?>">
		<span class="message"></span>
		<button class="button" onclick="updateEmail('email')">SALVAR</button>
	</div>

	<div class="container">
		<h2>Senha</h2>
		<input type="password" class="oldPassword" name="oldPassword" placeholder="Senha Atual">
		<input type="password" class="newPassword1" name="newPassword1" placeholder="Nova Senha">
		<input type="password" class="newPassword2" name="newPassword2" placeholder="Confirmar Senha">
		<span class="message"></span>
		<button class="button" onclick="updatePassword('oldPassword', 'newPassword1', 'newPassword2')">SALVAR</button>
	</div>

</div>