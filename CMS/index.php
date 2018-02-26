<?php
	session_start();
	include("functions/config.php"); 
	include("functions/main.php");
	include("functions/constants.php");
	if (isset($_POST["disconnection"]))
	{
		session_destroy();
	}
	else if (isset($_POST["connection"]))
	{
		$user = $mysqli->query("SELECT * FROM users WHERE email = '".secu($_POST['mail'])."' AND password = '".sha1(secu($_POST['pass']."';")));
		if ($user->num_rows > 0)
		{
			$_SESSION['user'] = $user->fetch_array(MYSQLI_ASSOC);
		}
		else
		{
			$erreur = true;
            $erreur_msg = "<strong>Erreur : </strong>Le nom d'utilisateur et le mot de passe que vous avez entrés ne correspondent pas à ceux présents dans nos fichiers.<br />Veuillez vérifier et réessayer.";
		}
	}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title><?php echo $name_application; ?> - Licences</title>

<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>
</head>
<body>

<nav class="navbar navbar-default" style="background-color:deepskyblue">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand"><?php echo $name_company; ?></a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Accueil<span class="sr-only">(current)</span></a></li>
		  <li><a href="index.php?p=register">S'enregistrer</a></li>
      </ul>
  <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<?php //TODO:User panel
				if (isset($_SESSION['user']))
				{
				?>
				<span class="glyphicon glyphicon-user"></span>Bienvenue <?php echo $_SESSION['user']['firstname']; ?> !<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<?php
							if ($_SESSION['user']['admin'] > 0)
							{
								?>
								<li><a href="./admin/">Panneau d'administration</a></li>
								<?php		
							}
							?>
							<li><a href="index.php?p=profile">Mon profil</a></li>
							<li><a href="index.php?p=mylicenses">Mes licences</a></li>
							<form id="formDisconnection">
							<input type="hidden" name="disconnection" />
							</form>
							<li><a href='#' onclick='document.getElementById("formDisconnection").submit()'>Déconnexion</a></li>
						</ul>
		  		<?php
				}
				else
				{
				?>
			<span class="glyphicon glyphicon-user" style="margin-right:5px;"></span>Se connecter <span class="caret"></span></a>
				<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">
								 <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
										<div class="form-group">
											 <label class="sr-only" for="exampleInputEmail2">Mail</label>
											 <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Adresse mail" required>
										</div>
										<div class="form-group">
											 <label class="sr-only" for="exampleInputPassword2">Mot de passe</label>
											 <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Mot de passe" required>
                                             <div class="help-block text-right"><a href="index.php?p=forgotpw">Mot de passe oublié ?</a></div>
										</div>
										<div class="form-group">
											 <button type="submit" class="btn btn-primary btn-block">Connexion</button>
										</div>
										<div class="checkbox">
											 <label>
											 <input type="checkbox"> Se souvenir de moi
											 </label>
										</div>
								 </form>
							</div>
							<div class="bottom text-center">
								Pas encore enregistré ? <a href="index.php?p=register"><b>Rejoignez-nous !</b></a>
							</div>
					 </div>
				</li>
			</ul>
				<?php
				}
				
				?>
		</li>
		 
          <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Panier <span class="badge" style="font-size: 10px;">3</span></a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

	<?php
			if (isset($_GET['p']) && file_exists('pages/'.$_GET['p'].'.php'))
			{
				include('pages/'.$_GET['p'].'.php');
			}else
			{
				include('pages/home.php');
			}
	?>
	<hr>
  <div class="row">
    <div class="text-center col-md-6 col-md-offset-3">
		<p>Copyright <span class="glyphicon glyphicon-copyright-mark"></span> 2017 - <?php echo date('Y'); ?> &middot; Tous droits réservés</p>
		<p><a href="#">Webmaster</a> &middot; <a href="#">Support</a> &middot; <a href="#">Mentions légales</a></p>
    </div>
  </div>
<div id="fb-root"></div>
<script src="js/facebook.js"></script>
</body>
</html>
