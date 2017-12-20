<?php
$secret = "6LcwfT0UAAAAACK73T5Ip9N_Q1osLud1EXntHJSN";
$erreur = false;
$empty_register = false;
$erreur_msg = "";
if ( isset( $_POST[ 'register' ] ) ) {
    $firstname = secu($_POST[ 'firstname' ], $mysqli);
    $lastname = secu($_POST[ 'lastname' ], $mysqli);
    $mail = secu($_POST[ 'mail' ], $mysqli);
    $password = secu($_POST[ 'pass' ], $mysqli);
    $vpassword = secu($_POST[ 'vpass' ], $mysqli);
    if ( empty( $_POST[ 'username' ] ) && isRecaptchaValid( $_POST[ 'g-recaptcha-response' ] ) ) //validate button + hidden input empty + captcha
    {
        if ( $firstname != null && $lastname != null && $mail != null && $password != null && $vpassword != null) {
            if ( $password == $vpassword ) {
                if ( strlen( $password ) >= 12 ) {
                    if ( substr_count( $_POST[ 'mail' ], '@' ) > 0 ) {
                        if ( $mysqli->query( "SELECT mail FROM users WHERE mail = '" . $mail . "';" )->num_rows == 0 ) {
                                $mysqli->query( "INSERT INTO users VALUES ('','" . $firstname . "', '".$lastname."','" .$mail. "','" . sha1( $password ) . "','','0');");
								?>
							<div class="row">
								<div class="col-md-offset-2 col-md-8">
									<div class="alert alert-success">
									  <strong>Succès :</strong> Votre compte a bien été créé !<br />
									</div>
								</div>
							</div>
							<?php

					} else {
                        $erreur = true;
                        $erreur_msg = "L'adresse mail <strong>" . $mail . "</strong> est déjà utilisée.";
                    }
                    } else {
                        $erreur = true;
                        $erreur_msg = "L'adresse mail <strong>" . $mail . "</strong> est invalide.";
                    }
                } else {
                    $erreur = true;
                    $erreur_msg = "Votre mot de passe doit contenir au minimum <strong>12</strong> caractères.<br /><a href='https://www.economie.gouv.fr/particuliers/creer-mot-passe-securise' target='_blank'>Comment créer un mot de passe sécurisé et simple à retenir ?</a>";
                }
            } else {
                $erreur = true;
                $erreur_msg = "Les mots de passe ne correspondent pas.";
            }

        } else {
            $empty_register = true;
            $erreur = true;
            $erreur_msg = "Renseignez correctement tous les champs.";
        }

    } else {
        $erreur = true;
        $erreur_msg = "Captcha incorrect.";
    }

    if ( $erreur ) {
        ?>
			<div class="row">
			<div class="col-md-offset-2 col-md-8">
        <div class="alert alert-danger">
            <strong>L'inscription a échoué : </strong>
            <?php echo $erreur_msg; ?>
        </div>
				</div>
				</div>
        <?php
    }
} else {
    $firstname = null;
    $lastname = null;
    $mail = null;
    $password = null;
    $vpassword = null;
}


?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h1 class="text-center">Inscription</h1>
		<div class="text-center">Prenez soin de remplir tous les champs.</div>
    </div>
  </div>
  <hr>
</div>
				
                <form id="register" action="" method="post">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                            <div class="form-group <?php if ($empty_register && $firstname == null) {echo "has-error has-feedback";}?>">
                                <label for="firstname">Prénom</label>
                                <input type="text" class="form-control" name="firstname" placeholder="Michel" value="<?php echo $firstname; ?>"
								<?php
								if ($empty_register && $firstname == null) 
								{
									?>aria-describedby="inputError2Status">
									<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  									<span id="inputError2Status" class="sr-only">(error)</span>
								<?php
								}else
								{
									echo ">";
								}
								?>
                            </div>
                        </div>
					</div>
					<div class="row">
                        <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                            <div class="form-group <?php if ($empty_register && $lastname == null) {echo "has-error has-feedback";}?>">
                                <label for="lastname">Nom</label>
                                <input type="text" class="form-control" name="lastname" placeholder="Dupont" value="<?php echo $lastname; ?>"
								<?php
								if ($empty_register && $lastname == null) 
								{
									?>aria-describedby="inputError2Status">
									<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  									<span id="inputError2Status" class="sr-only">(error)</span>
								<?php
								}else
								{
									echo ">";
								}
								?>
                            </div>
                        </div>
					</div>
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                            <div class="form-group <?php if ($empty_register && $mail == null) {echo "has-error has-feedback";}?>">
                                <label for="Email">Adresse mail</label>
                                <input type="text" class="form-control" name="mail" placeholder="exemple@exemple.com" value="<?php echo $mail; ?>"
								<?php
								if ($empty_register && $mail == null) 
								{
									?>aria-describedby="inputError2Status">
									<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  									<span id="inputError2Status" class="sr-only">(error)</span>
								<?php
								}else
								{
									echo ">";
								}
								?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                            <div class="form-group <?php if ($empty_register && $password == null) {echo "has-error has-feedback";}?>">
                                <label for="Password">Mot de passe</label>
                                <input type="password" class="form-control" name="pass" placeholder="Mot de passe" value="<?php echo $password; ?>"
								<?php
								if ($empty_register && $password == null) 
								{
									?>aria-describedby="inputError2Status">
									<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  									<span id="inputError2Status" class="sr-only">(error)</span>
								<?php
								}else
								{
									echo ">";
								}
								?>
                            </div>
                        </div>
					</div>
					<div class="row">
                        <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                            <div class="form-group <?php if ($empty_register && $vpassword == null) {echo "has-error has-feedback";}?>">
                                <label for="Vpassword">Vérification mot de passe</label>
                                <input type="password" class="form-control" name="vpass" placeholder="Vérification mot de passe" value="<?php echo $vpassword; ?>"
								<?php
								if ($empty_register && $vpassword == null) 
								{
									?>aria-describedby="inputError2Status">
									<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  									<span id="inputError2Status" class="sr-only">(error)</span>
								<?php
								}else
								{
									echo ">";
								}
								?>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="padding-bottom:1%;">
                        <div class="col-lg-offset-2 col-lg-8">
                            <center>
                                <div class="g-recaptcha" data-sitekey="<?php echo $secret; ?>"></div>
                            </center>
                        </div>
                    </div>

					<p style="visibility:hidden;">Username: <input name="username" type="text"/></p>
                    <!-- antibot field -->
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                            <p class="text-center">
                                <button name="register" type="submit" class="btn btn-success btn-lg">Terminer l'inscription</button>
                            </p>
                        </div>
                    </div>
                </form>
			</div>
            </div>
        <div class="col-lg-3"></div>
    </div>