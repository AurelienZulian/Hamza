<div class="container-fluid">
	
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h1 class="text-center"><?php echo $name_application; ?></h1>
    </div>
  </div>
  <hr><!-- TODO: if not connected -->
	<div class="row">
    	<div class="col-md-6 col-md-offset-3">
			<div class="alert alert-success">
  				<center><a href="index.php?p=register">Inscrivez-vous</a> dès maintenant et bénéficiez de <strong>30 jours</strong> d'essai !</center>
			</div>
		</div>
	</div>
</div>
<div class="container">
  <div class="row text-center">
    <div class="col-md-6 col-md-offset-3">
	Nous proposons de nombreuses licences.<br />Vous pouvez en choisir parmi celles proposées ci-dessous !  
	</div>
  </div>
  <hr>
	
	<div class="row">
		<div class="col-sm-6">
		<div class="panel panel-default">
	  <!-- Default panel contents -->
	<div class="panel-heading"><center>Abonnements</center></div>
	  <div class="panel-body">
		<div class="table-responsive">
	  		<table class="table">
				<?php
			
			$sql_licenses = "SELECT * FROM types_licenses WHERE auto_renewal = 1;"; 
			$result_licenses = $mysqli->query($sql_licenses);
			$i = 0;
			while($row_licenses = $result_licenses->fetch_assoc())
			{
				echo "<th><center>".$row_licenses["name"]."</center></th>";
			}
			?>
			<tr>
			<?php
				$i = 0;
				$result_licenses = $mysqli->query($sql_licenses);
			while($row_licenses = $result_licenses->fetch_assoc())
			{
				?>
				<td>
					<center>
						<button type="button" class="btn btn-default"><?php echo $row_licenses["price"]; ?> <span class="glyphicon glyphicon-credit-card" style="font-size: 11px;"></span></button>
					</center>
				</td>
			<?php
			}
			?>
			</tr>
			</table>
		</div>
	</div>
</div>
		</div>
		<div class="col-sm-6">
		<div class="panel panel-default">
	  <!-- Default panel contents -->
	<div class="panel-heading"><center>Licences</center></div>
	  <div class="panel-body">
		<div class="table-responsive">
	  		<table class="table">
				<?php
			
			$sql_licenses = "SELECT * FROM types_licenses WHERE auto_renewal = 0;"; 
			$result_licenses = $mysqli->query($sql_licenses);
			$i = 0;
			while($row_licenses = $result_licenses->fetch_assoc())
			{
				echo "<th><center>".$row_licenses["name"]."</center></th>";
			}
			?>
			<tr>
			<?php
				$i = 0;
				$result_licenses = $mysqli->query($sql_licenses);
			while($row_licenses = $result_licenses->fetch_assoc())
			{
				?>
				<td>
					<center>
						<button type="button" class="btn btn-default"><?php echo $row_licenses["price"]; ?></div> <span class="glyphicon glyphicon-credit-card" style="font-size: 11px;"></button>
					</center>
				</td>
			<?php
			}
			?>
			</tr>
			</table>
		</div>
	</div>
</div>
		</div>

	</div>