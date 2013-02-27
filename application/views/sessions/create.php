
<div class="row">
	<div class="twelve columns">
		<h3>Connexion</h3>
	</div>
</div>

<div class="row">
	<div class="five columns">
		<?php echo form_open('sessions/create', array('id' => 'connexionForm')) ?>
			<label>Email</label>
		 	<input type="text" class="required email" name="email" />
		 	<label>Mot de passe</label>
		 	<input type="password" class='required' name="motdepasse" />
		 	<input type="submit" class="button" value="Envoyer" />
		<?php echo form_close() ?>

		<a href="<?php echo base_url() ?>/index.php/users/create">Pas encore inscrit ?</a>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
      	$("#connexionForm").validate();
	});
</script>