
<div class="container">

<div class="row">
	<div class="span12">
		<h3>Connexion</h3>
	</div>
</div>

<div class="row">
	<div class="span5">
		<?php echo form_open('sessions/create', array('id' => 'connexionForm')) ?>
			<label>Email</label>
		 	<input type="text" class="required email" name="email" />
		 	<label>Mot de passe</label>
		 	<input type="password" class='required' name="motdepasse" />
		 	<br/>
		 	<input type="submit" class="btn btn-success" value="Envoyer" />
		<?php echo form_close() ?>

		<a href="<?php echo site_url('users/create'); ?>">Nouvel utilisateur ?</a>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
      	$("#connexionForm").validate();
	});
</script>



</div>


