
<img class="banner" src="<?php echo base_url('images/halfcity.jpg'); ?>" />

<br/><br/>

<?php if(validation_errors()){ ?>
<div class="row">
	<div class="">
		<div class="alert-box alert">
  		<?php echo validation_errors(); ?>
  		<a href="" class="close">&times;</a>
		</div>
	</div>
</div>
<?php } ?>

<?php if($feedback){ ?>
<div class="row">
	<div class="">
		<div class="alert-box success">
  		<?php echo $feedback; ?>
  		<a href="" class="close">&times;</a>
		</div>
	</div>
</div>
<?php } ?>



<div class="row">
	<div class="twelve columns">
		<h1>Profil <small><?php echo $nom . ' ' .$prenom; ?></small></h1>
	</div>
</div>

<br/><br/>

<div class="row">
	<div class="six columns">
		<?php echo form_open('users/update/' . $id,array('id' => 'editForm')); ?>
		<label>Nom</label>
		<input type="text" class="required" name="nom" value="<?php echo $nom; ?>" />
		<label>Prenom</label>
		<input type="text" class="required" name="prenom" value="<?php echo $prenom; ?>" />
		<label>Email</label>
		<input type="text" class="required email" name="email" value="<?php echo $email; ?>" />
		<label>Téléphone Mobile</label>
		<input type="text" class="required digits" name="telephone" value="<?php echo $telephone; ?>" />
		<label>Ancien Mot de passe</label>
		<input type="password" class="required" name="ancien_motdepasse" />
		<label>Nouveau mot de passe</label>
		<input type="password" class="required" name="motdepasse" />
		<label>Confirmer nouveau mot de passe</label>
		<input type="password" class="required" name="confirmation_motdepasse" />
		<input type="submit" class="button success" value="Mettre à jour" />
		<input type="reset" class="button secondary" value="Annuler" />
		<?php echo form_close(); ?>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
      	$("#editForm").validate();
	});
</script>
		
	


