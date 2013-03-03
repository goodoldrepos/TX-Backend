<div class="container">
	<div class="row">
		<div class="span12">
			<h1>Administration</h1>
			<br/><br/>
			<div class="tabbable tabs-right">
  				<ul class="nav nav-tabs">
  					<li class="active"><a href="#tab1" data-toggle="tab">Clients</a></li>
    				<li><a href="#tab2" data-toggle="tab">Réservations</a></li>
    				<li><a href="#tab3" data-toggle="tab">Chaffeurs</a></li>

  				</ul>
  				<div class="tab-content">
  					<div class="tab-pane active" id="tab1">
      					
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
      					<table class="table table-striped">
								<thead><th>#</th><th>Depart</th><th>Destination</th><th>Client</th><th>Statut</th><th>&nbsp;</th></thead>
								<?php foreach($reservations as $reservation){ ?>
								<tr>
									<td>
										<?php echo $reservation->id; ?>
									</td>
									<td>
										<?php echo $reservation->rue; ?>
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
										<a href="<?php echo site_url(''); ?>">
											<i class='icon-ok-circle'></i>
										</a>
										<a href="">
											<i class='icon-remove-circle'></i>
										</a>
									</td>
								</tr>
								<?php } ?>
						</table>
    				</div>
    				<div class="tab-pane" id="tab3">
      					<table class="table">
								<thead><th>Nom</th><th>Chaffeur</th></thead>
								<?php foreach($reservations as $reservation){ ?>
								<tr>
									<td>
										<?php echo $reservation->id_utilisateur; ?>
									</td>
									<td>
										<?php echo $reservation->id_depart; ?>
									</td>
								</tr>
								<?php } ?>
						</table>
    				</div>
  				</div>
			</div>
		</div>
	</div>
</div>