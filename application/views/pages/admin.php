<div class="container">
	<div class="row">
		<div class="span12">
			<h1>Administration</h1>
			<br/><br/>
			<div class="tabbable tabs-right">
  				<ul class="nav nav-tabs">
  					<li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-user"></i> Clients</a></li>
    				<li><a href="#tab2" data-toggle="tab"><i class="icon-road"></i> Réservations</a></li>
    				<li><a href="#tab3" data-toggle="tab"><i class="icon-screenshot"></i> Chaffeurs</a></li>

  				</ul>
  				<div class="tab-content">
  					<div class="tab-pane active" id="tab1">
      						<h3>Liste des clients</h3>

      						<table class="table table-striped">
								<thead><th>Nom</th><th>Email</th><th>&nbsp;</th></thead>
								<?php foreach($users as $user){ ?>
								<tr>
									<td>
										<a href="<?php echo site_url('users/show') . '/' . $user->id; ?>" >
											<?php echo $user->nom . ' ' . $user->prenom; ?>
										</a>
									</td>
									<td>
										<?php echo $user->email; ?>
									</td>
									<td>
										<a href="<?php echo site_url('users/destroy') . '/' . $user->id ; ?>">
											<i class="icon-trash"></i>
										</a>
									</td>
								</tr>
								<?php } ?>
							</table>
								
    				</div>
    				<div class="tab-pane" id="tab2">
    					<h3>Liste des réservations</h3>
      					<table class="table table-striped">
								<thead><th>#</th><th>Départ</th><th>Destination</th><th>Client</th><th>Statut</th><th>&nbsp;</th></thead>
								<?php foreach($reservations as $reservation){ ?>
								<tr>
									<td>
										<?php echo $reservation->id; ?>
									</td>
									<td>
										<?php echo $reservation->rue . ', ' . $reservation->ville ; ?>
									</td>
									<td>
										<?php echo $reservation->destination; ?>
									</td>
									<td>
										<?php echo $reservation->nom . ' ' . $reservation->prenom; ?>
									</td>
									<td>
										<?php 
											if($reservation->statut != 'disponible'){
												echo "<i class='icon-ok'></i>";
											}else{
												echo "<i class='icon-map-marker'></i>";
											}
										?>
											 
									</td>
									<td>
										<?php 
											if($reservation->statut == 'disponible'){
												echo "<a href=". site_url('reservations/destroy') . '/' . $reservation->id . "><i class='icon-ok-circle'></i></a>";
											}else{
												echo "&nbsp;";
											}
										?>
										
								
									</td>
								</tr>
								<?php } ?>
						</table>
    				</div>
    				<div class="tab-pane" id="tab3">
      					
    				</div>
  				</div>
			</div>
		</div>
	</div>
</div>

