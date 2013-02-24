<script type="text/javascript">
   $(window).load(function() {
       $("#featured").orbit({ advanceSpeed:10000});
   });
</script>

	<style type="text/css">
    	.formulaire{
    		width:300px;
    		position: relative;
    		padding-left: 15px;
    		padding-right: 15px;

    		#left:380px;
    		bottom:300px;
    		display: block;
  			margin-left: auto;
 			margin-right: auto;
    		background-color:white;
    		z-index: 10;
    		border:black solid 1px;

    		-webkit-box-shadow: -1px 3px 5px rgba(50, 50, 50, 0.36);
			-moz-box-shadow:    -1px 3px 5px rgba(50, 50, 50, 0.36);
			box-shadow:         -1px 3px 5px rgba(50, 50, 50, 0.36);
  			
    	}
    	.banner{
    		position:relative;
    		width:100%;
		}
    </style>


    <div class="banner"></div>
    <img class="banner" src="<?php echo base_url() ?>images/paris.jpg" />

    
    <div class="formulaire" >
    	<?php echo validation_errors(); ?>
    	<?php echo form_open('reservations/immediate') ?>
			<fieldset>
    		<legend>Demande immédiate</legend>
			<label>Départ</label>
					<input type="text" name="ville" placeholder="Ville" />
					<input type="text" name="rue" placeholder="Rue" />
					<input type="text" name="code_postale" placeholder="Code Postale" />
			<label>Destination</label>
			<input type="text" name="destination" placeholder="Rue" />	
			<label>Nombre de passagers</label>
			<select name="nombre_passagers">
				<option name="1" >1</option>
				<option name="2" >2</option>
			</select>
			<br/><br/>
			<label>Nombre de bagages</label>
			<select name="nombre_bagages">
				<option name="1" >1</option>
				<option name="2" >2</option>
			</select>
			<br/><br/>
			<input type="submit" class="small button right" value="Continuer" >
			<?php echo form_close() ?>
			</fieldset>
    </div>


<!--
<div class="row">
		<div class="five columns">
			<?php echo form_open('reservation/immediat') ?>
			<fieldset>
    		<legend>Taxi Immediat</legend>
			<label>Depart:</label>
				<div class="row">
				<div class="six columns">
					<input type="text" placeholder="Ville" />
				</div>
				<div class="three columns">
					<input type="text" placeholder="Rue" />
				</div>
				<div class="three columns">
					<input type="text" placeholder="CP" />
				</div>
			</div>
			<label>Destination:</label>
			<input type="text" placeholder="Rue" />	
			<label>Nombre de passagers:</label>
			<select>
				<option>1</option>
				<option>2</option>
			</select>
			<br/><br/>
			<label>Nombre de bagages:</label>
			<select>
				<option>1</option>
				<option>2</option>
			</select>
			<br/><br/>
			<input type="submit" class="small button right" value="Immediat" >
			<?php echo form_close() ?>
			</fieldset>
		</div>
		<div class="seven columns">
			<br/><br/>
			<div id="featured">
  				<img src="<?php echo base_url(); ?>/images/demo1.jpg" />
  				<img src="<?php echo base_url(); ?>/images/demo2.jpg" />
  				<img src="<?php echo base_url(); ?>/images/demo3.jpg" />
			</div>
		</div>
	</div>