
    <img class="banner" src="<?php echo base_url('images/halfcity.jpg'); ?>" />

    <div class="row">
    	
    	<div class="six columns">
    	<?php echo validation_errors(); ?>
    	<?php echo form_open('chaffeurs/create') ?>
		<fieldset>
    	<legend>Inscription Chaffeur</legend>
    		<input type="text" name="nom" placeholder="Nom" />
			<input type="text" name="prenom" placeholder="Prenom" />
			<input type="text" name="email" placeholder="Email" />
			<input type="text" name="telephone" placeholder="Telephone" />
			<input type="text" name="motdepasse" placeholder="Mot de passe" />
			<input type="text" name="adresse" placeholder="Adresse" />
			<input type="text" name="code_postale" placeholder="Code Postale" />
			<input type="text" name="ville" placeholder="Ville" />
			<input type="text" name="num_stationnement" placeholder="Numero de Stationnement" />
			<input type="text" name="num_carte_pro" placeholder="Numero Carte Pro" />
			<input type="text" name="immatriculation" placeholder="Immatriculation" />
			<input type="text" name="marque" placeholder="Marque" />
			<input type="text" name="modele" placeholder="Modele" />
			<input type="text" name="couleur" placeholder="Couleur" />
			<input type="text" name="commune_exercice" placeholder="Commune Exercice" />
			<input type="text" name="smartphone" placeholder="Smartphone" />
    		<input type="submit" class="small button right" value="Continuer" >
			<br/><br/>
		</fieldset>
    	<?php echo form_close() ?>
			
    	</div>
    	<div class="six columns">
			
    		
    	</div>
    	
    </div>

    