<div class="container">
	<div class="row">
		<div class="span12">
			<h1>Administration</h1>
			<br/><br/>
			<div class="tabbable tabs-right">
  				<ul class="nav nav-tabs">
  					<li class="active" ><a href="#tab2" data-toggle="tab"><i class="icon-road"></i> Réservations</a></li>
  					<li ><a href="#tab1" data-toggle="tab"><i class="icon-user"></i> Clients</a></li>
    				<li><a href="#tab3" data-toggle="tab"><i class="icon-screenshot"></i> Chaffeurs</a></li>

  				</ul>
  				<div class="tab-content">
  					<div class="tab-pane " id="tab1">
      						<h3>Liste des clients</h3>

      						<table class="table table-bordered table-striped">
								<thead><th>Prénom Nom</th><th>Adresse email</th><th>&nbsp;</th></thead>
								<?php foreach($users as $user){ ?>
								<tr>
									<td>
										<a href="<?php echo site_url('users/show') . '/' . $user->id; ?>" >
											<?php echo $user->prenom . ' ' . $user->nom; ?>
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
    				<div class="tab-pane active" id="tab2">
    					<h3>Liste des réservations</h3>
      					<table class="table table-bordered table-striped">
								<thead><th>#</th><th>Client</th><th>Adresse de départ</th><th>Adresse de destination</th><th>Statut</th><th>&nbsp;</th></thead>

								<?php if(count($reservations) != 0) foreach($reservations as $reservation){ ?>
								<tr>
									<td>
										<?php echo $reservation->id; ?>
									</td>
									<td>
										<?php echo $reservation->prenom . ' ' . $reservation->nom; ?>
									</td>
									<td>
										<?php echo $reservation->adresse; ?>
									</td>
									<td>
										<?php echo $reservation->destination; ?>
									</td>
									
									<td>
										<?php 
											echo $reservation->status . ".";
										?>
											 
									</td>
									<td>
										<?php 
											if($reservation->status == 'pending'){
												echo "<a href=". site_url('reservations/destroy') . '/' . $reservation->id . ">Annuler</a>";
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

