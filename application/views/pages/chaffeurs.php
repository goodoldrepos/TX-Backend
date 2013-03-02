
<img class="banner" src="<?php echo base_url('images/halfcity.jpg'); ?>" />

<div class="container">
    <div class="row">
    	<div class="span6">
    	<?php echo validation_errors(); ?>
    	<?php echo form_open('chaffeurs/create') ?>
    	<legend>Inscription Chaffeur</legend>
    		<input type="text" class="input-block-level" name="nom" placeholder="Nom" />
			<input type="text" class="input-block-level" name="prenom" placeholder="Prenom" />
			<input type="text" class="input-block-level" name="email" placeholder="Email" />
			<input type="text" class="input-block-level" name="telephone" placeholder="Telephone" />
			<input type="text" class="input-block-level" name="motdepasse" placeholder="Mot de passe" />
			<input type="text" class="input-block-level" name="adresse" placeholder="Adresse" />
			<input type="text" class="input-block-level" name="code_postale" placeholder="Code Postale" />
			<input type="text" class="input-block-level" name="ville" placeholder="Ville" />
			<input type="text" class="input-block-level" name="num_stationnement" placeholder="Numero de Stationnement" />
			<input type="text" class="input-block-level" name="num_carte_pro" placeholder="Numero Carte Pro" />
			<input type="text" class="input-block-level" name="immatriculation" placeholder="Immatriculation" />
			<input type="text" class="input-block-level" name="marque" placeholder="Marque" />
			<input type="text" class="input-block-level" name="modele" placeholder="Modele" />
			<input type="text" class="input-block-level" name="couleur" placeholder="Couleur" />
			<input type="text" class="input-block-level" name="commune_exercice" placeholder="Commune Exercice" />
			<input type="text" class="input-block-level" name="smartphone" placeholder="Smartphone" />
    		<input type="submit" class="btn btn-success" value="Continuer" >
			<br/><br/>
    	<?php echo form_close() ?>	
    	</div>    	
    </div>
</div>


    