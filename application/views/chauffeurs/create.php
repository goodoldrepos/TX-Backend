
<img class="banner" src="<?php echo base_url('images/halfcity.jpg'); ?>" />

<div class="container">
    <div class="row">
      <div class="page-header">
        <h1>Inscription</h1>
      </div>
    	<div class="span6">
    	<?php echo validation_errors(); ?>
    	<?php echo form_open('chauffeurs/create') ?>
    		<label>Nom</label>
    		<input class="input-block-level" type="text" name="nom" placeholder="" />
    		<label>Prénom</label>
    		<input class="input-block-level" type="text" name="prenom" placeholder="" />
			<label>Email</label>
 			<input type="text" class="input-block-level" name="email" placeholder="" />
 			<label>Téléphone</label>
			<input type="text" class="input-block-level" name="telephone" placeholder="" />
			<label>Mot de passe</label>
  			<input type="password" class="input-block-level" name="motdepasse" placeholder="" />
  			<label>Addresse</label>
 			<input type="text" class="input-block-level" name="adresse" placeholder="" />
 			<label>Numéro de Stationnement</label>
			<input type="text" class="input-block-level" name="num_stationnement" placeholder="" />
			<label>Numéro Carte Pro</label>
			<input type="text" class="input-block-level" name="num_carte_pro" placeholder="" />
			<label>Immatriculation</label>
			<input type="text" class="input-block-level" name="immatriculation" placeholder="" />
			<label>Commune Exercice</label>
			<input type="text" class="input-block-level" name="commune_exercice" placeholder="" />
    		<input type="submit" class="btn btn-success" value="Continuer" >
			<br/><br/>
    	<?php echo form_close() ?>	
    	</div>    	
    </div>
</div>


    