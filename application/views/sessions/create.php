
<div class="row">
	<div class="twelve columns">
		<h3>Connexion</h3>
	</div>
</div>

<div class="row">
	<div class="five columns">
		<?php echo form_open('sessions/create') ?>
			<label>Email</label>
		 	<input type="text" name="email" />
		 	<label>Mot de passe</label>
		 	<input type="password" name="motdepasse" />
		 	<input type="submit" class="button" value="Envoyer" />
		<?php echo form_close() ?>

		<a href="<?php echo base_url() ?>/index.php/users/create">Pas encore inscrit ?</a>
	</div>
</div>