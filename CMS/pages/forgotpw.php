<?php
$erreur = false;
$empty = false;
$erreur_msg = "";
$mail = null;
if ( isset( $_POST[ 'recover-submit' ] ) ) {
    $mail = secu($_POST[ 'email' ], $mysqli);
	if ($mail != null)
	{
		sendMail($mail, "pwd", $mysqli);
		?>
		<div class="row">
    		<div class="col-md-6 col-md-offset-3">
				<div class="alert alert-success">
					<center>Un mail a bien été envoyé à <?php echo $mail; ?> si un compte existe avec ce mail.</center>
				</div>
			</div>
		</div>
		<?php
	}
}
else
{
	 $mail = null;
}
	
?>


 <link rel="stylesheet" href="css/font-awesome.min.css">
 <div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Mot de passe oublié</h2>
                  <p>Procédure de réinitialisation de mot de passe.</p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="Adresse mail" class="form-control"  type="email" value="<?php echo $mail; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Réinitialiser" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
