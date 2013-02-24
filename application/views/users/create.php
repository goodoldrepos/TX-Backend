<div class="row">
	<div class="twelve columns">
		<h3>Inscription</h3>
	</div>
</div>

<div class="row">
	<div class="five columns">
		<?php echo validation_errors(); ?>
		<?php echo form_open('users/create') ?>
			<label>Nom</label>
			<input type="text" name="nom" />
			<label>Prenom</label>
			<input type="text" name="prenom" />
			<label>Telephone</label>
			<input type="text" name="telephone" />
			<label>Email</label>
			<input type="text" name="email" />
			<label>Mot de passe</label>
			<input type="password" name="motdepasse" />
			<input type="submit" class="button" value="Envoyer" >
		<?php echo form_close() ?>

		<a href="<?php echo base_url() ?>/index.php/sessions/create">Déjà inscrit ?</a>
	</div>
</div>