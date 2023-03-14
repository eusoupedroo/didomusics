<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}
?>

<html>
<head>
	<title>DidoMusic - Subscribe </title>

	<link rel="stylesheet" type="text/css" href="assets/css/register.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
	<?php

	if(isset($_POST['registerButton'])) {
		echo '<script>
				$(document).ready(function() {
					$("#loginForm").hide();
					$("#registerForm").show();
				});
			</script>';
	}
	else {
		echo '<script>
				$(document).ready(function() {
					$("#loginForm").show();
					$("#registerForm").hide();
				});
			</script>';
	}

	?>
	

	<div id="background">

		<div id="loginContainer">

			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<h2>Acesse Sua Conta</h2>
					<p>
						<?php echo $account->getError(Constants::$loginFailed); ?>
						<input id="loginUsername" name="loginUsername" type="text" placeholder="Nome de Usuário" value="<?php getInputValue('loginUsername') ?>" required>
					</p>
					<p>
						<input id="loginPassword" name="loginPassword" type="password" placeholder="Senha" required>
					</p>

					<button type="submit" name="loginButton">Entrar</button>

					<div class="hasAccountText">
						<span id="hideLogin">Ainda não tem uma conta ? Cadastre-se gratuitamente por aqui.</span>
					</div>
					
				</form>



				<form id="registerForm" action="register.php" method="POST">
					<h2>Juntar-se</h2>
					<p>
						<?php echo $account->getError(Constants::$usernameCharacters); ?>
						<?php echo $account->getError(Constants::$usernameTaken); ?>
						<input id="username" name="username" placeholder="Nome de Usuário" type="text" value="<?php getInputValue('username') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$firstNameCharacters); ?>
						<input id="firstName" name="firstName"  placeholder="Primeiro Nome" type="text"value="<?php getInputValue('firstName') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$lastNameCharacters); ?>
						<input id="lastName" name="lastName" type="text" placeholder="Último Nome" value="<?php getInputValue('lastName') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$emailInvalid); ?>
						<?php echo $account->getError(Constants::$emailTaken); ?>
						<input id="email" name="email"  placeholder="E-mail" type="email"value="<?php getInputValue('email') ?>" required>
					</p>

					<p>
						
						<input id="email2" name="email2" placeholder="Confirmar E-mail" type="email" value="<?php getInputValue('email2') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
						<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
						<?php echo $account->getError(Constants::$passwordCharacters); ?>
						
						
						<input id="password" name="password" placeholder="Senha" type="password"  required>
					</p>

					<p>
						
						<input id="password2" name="password2" type="password" placeholder="Confirmar Senha" required>
					</p>

					<button type="submit" name="registerButton">Acessar</button>

					<div class="hasAccountText">
						<span id="hideRegister">Já possui uma conta ? Acesse-a.</span>
					</div>
					
				</form>


			</div>

			<div id="loginText">
				<h1>Dido, seu site de musicas nostálgicas</h1>
				<ul>
					<li>Descubra músicas;</li>
					<li>Crie Sua Playlist;</li>
					<li>Favorite seus álbuns;</li>
					<li>Site destinado para amantes de músicas dos anos 90 aos 2000;</li>
					<li>Este é um projeto 100% didático, sem fins lucrativos; </li>
				</ul>
			</div>

		</div>
	</div>

</body>
</html>