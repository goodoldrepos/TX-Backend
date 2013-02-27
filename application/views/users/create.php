<div class="row">
	<div class="twelve columns">
		<h3>Inscription</h3>
	</div>
</div>

<div class="row">
	<div class="five columns">
		<?php echo validation_errors(); ?>
		<?php echo form_open('users/create', array('id' => 'inscriptionForm')) ?>
			<label>Nom</label>
			<input type="text" class="required" name="nom" />
			<label>Prénom</label>
			<input type="text" class="required" name="prenom" />
			<label>Téléphone Mobile</label>
			<input type="text" class="required digits" name="telephone" />
			<label>Email</label>
			<input type="text" class="required email" name="email" />
			<label>Mot de passe</label>
			<input type="password" class="required" name="motdepasse" />
			<input type="submit" class="button" value="Envoyer" >
		<?php echo form_close() ?>

		<a href="<?php echo base_url() ?>/index.php/sessions/create">Déjà inscrit ?</a>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
      	$("#inscriptionForm").validate();
	});
</script>