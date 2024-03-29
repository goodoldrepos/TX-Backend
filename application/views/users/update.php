
<img class="banner" src="<?php echo base_url('images/halfcity.jpg'); ?>" />

<br/><br/>

<div class="container">

<?php if(validation_errors()){ ?>
<div class="row">
	<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
  		<?php echo validation_errors(); ?>
	</div>
</div>
<?php } ?>

<?php if($this->session->userdata('feedback')){ ?>

<div class="row">
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $this->session->userdata('feedback'); ?>
	</div>
</div>
<?php } ?>



<div class="row">
	<div class="span12">
        <div class="page-header">
            <h3>Modifier votre profil</h3>
        </div>
	</div>
</div>

<div class="row">
	<div class="span4">
		<?php echo form_open('users/update/' . $id,array('id' => 'editForm')); ?>
		<label>Votre nom</label>
		<input type="text" class="required input-block-level" name="nom" value="<?php echo $nom; ?>" />
		<label>Votre prénom</label>
		<input type="text" class="required input-block-level" name="prenom" value="<?php echo $prenom; ?>" />
		<label>Votre Email</label>
		<input type="text" class="required email input-block-level" name="email" value="<?php echo $email; ?>" />
		<label>Votre téléphone mobile</label>
		<input type="text" class="required digits input-block-level" name="telephone" value="<?php echo $telephone; ?>" />
		<br/>
		<input type="submit" class="btn btn-primary" value="Mettre à jour" />
		<input type="reset" class="btn" value="Annuler" />
		<?php echo form_close(); ?>
	</div>
</div>

<br/><br/>


    <div class="row">
        <div class="span12">
            <div class="page-header">
                <h3>Modifier mot de passe</h3>
            </div>
        </div>
    </div>

<div class="row">
	<div class="span4">
		<?php echo form_open('users/password/' . $id,array('id' => 'pwdForm')); ?>
		<label>Ancien mot de passe</label>
		<input type="password" class="required input-block-level" name="ancien_motdepasse" />
		<label>Nouveau mot de passe</label>
		<input type="password" class="required input-block-level" name="motdepasse" />
		<label>Confirmer nouveau mot de passe</label>
		<input type="password" class="required input-block-level" name="confirmation_motdepasse" />
		<br/>
		<input type="submit" class="btn btn-primary" value="Envoyer" />
		<input type="reset" class="btn" value="Annuler" />
		<?php echo form_close(); ?>
	</div>
</div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
      	$("#editForm").validate();
      	$("#pwdForm").validate();
	});
</script>
		
	


