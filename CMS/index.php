<?php
	include("functions/config.php"); 
	include("functions/main.php");
	include("functions/constants.php");
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
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand"><?php echo $name_company; ?></a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Accueil<span class="sr-only">(current)</span></a></li>
		  <li><a href="index.php?p=register">S'enregistrer</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Se connecter<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li style="margin-bottom:5px;"><input type="text" style="width:94%;margin-left:3%;" class="form-control" placeholder="Mail">
							</li>
							<li style="margin-bottom:5px;"><input type="password" style="width:94%;margin-left:3%;" class="form-control" placeholder="Mot de passe">
							</li>
							<li><a href="#">Connexion</a>
							</li>
						</ul>
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
				include('pages/home.php');
	?>
	<hr>
  <div class="row">
    <div class="text-center col-md-6 col-md-offset-3">
		<p>Copyright <span class="glyphicon glyphicon-copyright-mark"></span> 2017 - <?php echo date('Y'); ?> &middot; Tous droits réservés</p>
		<p><a href="#">Webmaster</a> &middot; <a href="#">Support</a>&middot; <a href="#">Mentions légales</a></p>
    </div>
  </div>

</body>
</html>
