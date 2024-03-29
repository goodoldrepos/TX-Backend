<div class="container">
	<div class="row">
		<div class="span12">
				<div class="page-header">
                <h1>Panneau d'administration</h1>
            </div>			
            <br/><br/>
			<div class="tabbable tabs-right">
  				<ul class="nav nav-tabs">
  					<li class="active" ><a href="#tab2" data-toggle="tab"><i class="icon-road"></i> Réservations</a></li>
  					<li ><a href="#tab1" data-toggle="tab"><i class="icon-user"></i> Clients</a></li>
    				<li><a href="#tab3" data-toggle="tab"><i class="icon-screenshot"></i> Chauffeurs</a></li>

  				</ul>
  				<div class="tab-content">
  					<div class="tab-pane " id="tab1">
      						<h2>Liste des clients</h2>
      						<table class="table table-bordered table-striped">
								<thead><th>Nom/Prénom</th><th>Numéro de portable</th><th>Adresse email</th><th>&nbsp;</th></thead>
								<?php foreach($users as $user){ ?>
								<tr>
									<td>
										<!--<a href="<?php echo site_url('users/show') . '/' . $user->id; ?>" > -->
											<?php echo $user->nom . ' ' . $user->prenom; ?>
										<!--</a>-->
									</td>
									<td>
										<?php echo $user->telephone; ?>
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
    					<h2>Historique des réservations</h2>
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
											if($reservation->status != 'done'){
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
      					<h2>Liste des chauffeurs</h2>
      					<table class="table table-bordered table-striped">
								<thead>
									<th>#</th>
									<th>Chauffeur</th>
									<th>Email</th>
									<th>Adresse</th>
									<th>Num de Telephone</th>
									<th>Licence Taxi</th>
									<th>Num carte pro</th>
									<th>Statut</th>		
								</thead>

								<?php if(count($chauffeurs) != 0) foreach($chauffeurs as $chauffeur){ ?>
								<tr>
									<td>
										<?php echo $chauffeur->id; ?>
									</td>
									<td>
										<?php echo $chauffeur->prenom . ' ' . $chauffeur->nom; ?>
									</td>
									<td>
										<?php echo $chauffeur->email; ?>
									</td>
									<td>
										<?php echo $chauffeur->adresse; ?>
									</td>
									<td>
										<?php echo $chauffeur->telephone; ?>
									</td>
									<td>
										<?php echo $chauffeur->licence; ?>
									</td>
									<td>
										<?php echo $chauffeur->num_carte_pro; ?>
									</td>
									<td>
										<?php if($chauffeur->valide == "pending"){ ?>
											<?php echo "<a href=". site_url('chauffeurs/activer/'). "/" . $chauffeur->id .">Valider</a>"; ?>
										<?php }elseif($chauffeur->valide == "ignored"){ ?>
											<?php echo "<a href=". site_url('chauffeurs/activer/'). "/" . $chauffeur->id .">Réactiver</a>"; ?>
										<?php }elseif($chauffeur->valide == "active"){ ?>
											<?php echo "<a href=". site_url('chauffeurs/ignorer/'). "/" . $chauffeur->id .">Désactiver</a>"; ?>
										<?php } ?>
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

