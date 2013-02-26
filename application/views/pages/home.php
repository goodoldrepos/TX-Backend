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

    		bottom:365px;
    		display: block;
  			margin-left: auto;
 			margin-right: auto;
    		background-color:white;
    		z-index: 10;
    		border:gray solid 1px;

    		-webkit-box-shadow: -1px 3px 5px rgba(50, 50, 50, 0.36);
            -moz-box-shadow: -1px 3px 5px rgba(50, 50, 50, 0.36);
            box-shadow: -1px 3px 5px rgba(50, 50, 50, 0.36);
  			
    	}
    	.banner{
    		position:relative;
    		width:100%;
		}

		.features{
			position:relative;
			bottom:330px;
			background: url("<?php echo base_url('images/features-bg.png'); ?>") no-repeat scroll 0 0 transparent;
		}

		.reasons{
			padding-top:40px;
            
		}

        .purple{
            color:#5C5592;
        }

        .feature{
            padding-top:40px;
        }

		.feature p {
			width:200px;
		}

        #linebreak {
            background: url("<?php echo base_url('images/linebreak.png'); ?>") center center no-repeat;
            height: 2px;
            border: 0;
            margin-bottom: 40px;
            border-color: transparent;
            position:relative;
        }

        .mobile{
            position:relative;
            bottom:250px;
        }

        .tarifs{
            position:relative;
            bottom:250px;
            padding-bottom: 50px;
        }

        .tarifs span{
            font-family: "open-sans","Helvetica Neue","Helvetica","Arial",sans-serif;
            font-size: 154px;
            line-height: 154px;
            text-align: center;
            color: #5C5592;
        }
    </style>

    <img class="banner" src="<?php echo base_url('images/paris.jpg'); ?>" />

    
    <div class="formulaire" >
    	<?php echo validation_errors(); ?>
    	<?php echo form_open('reservations/immediate', array('id' => 'reservationForm')) ?>
			<fieldset>
    		<legend>Demande immédiate</legend>
			<label>Départ</label>
					<input type="text" class="required" name="ville" placeholder="Ville" />
					<input type="text" class="required" class="required" name="rue" placeholder="Rue" />
					<input type="text" class="required" name="code_postale" placeholder="Code Postale" />
			<label>Destination</label>
			<input type="text" class="required" name="destination" placeholder="Adresse" />	
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
			<input type="submit" class="small button success right" value="Continuer" >
			<?php echo form_close() ?>
			</fieldset>
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
        $("#reservationForm").validate();
    });
</script>

    <div class="row features">
        <div class="row reasons">
            <div class="twelve columns">
                <center>
                    <h2>
                        <span class="purple">
                            3 raisons pour lesquelles <br/> vous allez adorer le Taxi Parisien !
                        </span>
                    </h2>
                </center>
            </div>
        </div>
        <div class="row">

        </div>
    	<div class="four columns feature">
    		<center>
    			<h3><small>Où que vous soyez</small></h3>
    			<img src="<?php echo base_url('images/phone.png'); ?>">
    			<p class="feature_text">
    			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in leo ipsum, id pretium lectus. Mauris at adipiscing urna. Proin id nulla nulla, nec fringilla velit. 
    			</p>
    		</center>
    	</div>
    	<div class="four columns feature">
    		<center>
    			<h3><small>Payer par carte</small></h3>
    			<img src="<?php echo base_url('images/card.png'); ?>">
    			<p>
    			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in leo ipsum, id pretium lectus. Mauris at adipiscing urna. Proin id nulla nulla, nec fringilla velit. 
    			</p>
    		</center>
    	</div>
    	<div class="four columns feature">
    		<center>
    			<h3><small>Soyez en sécurité</small></h3>
    			<img src="<?php echo base_url('images/taxi.png'); ?>">
    			<p>
    			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in leo ipsum, id pretium lectus. Mauris at adipiscing urna. Proin id nulla nulla, nec fringilla velit. 
    			</p>
    		</center>
    	</div>
    </div>

    <div class="row tarifs">
        <div class="twelve columns">
            <div id="linebreak"></div>
                <center>
                    <h3>+ Nos services sont totalement gratuit.</h3>
                    <span>0<sup><small>&#8364; *</small></sup></span>
                    <p>
                        <h5><small>
                            *Vous ne payez que pour le trajet jusqu'au point de rendez-vous lorsque le taxi est réservé.
                        </small></h5>
                    </p>
                </center>
                      
        </div>
    </div>

    <div class="row mobile">
        <div class="twelve columns">
            <div id="linebreak"></div>
                <center>
                <h2><span class="purple">Un taxi depuis votre smartphone.</span></h2>
                <h3><small>- Téléchargement gratuit - </small> </h3>
                <br/>
                <a href="#" data-reveal-id="myModal">
                    <img width="200px" src="<?php echo base_url('images/google_play_icon.png'); ?>">
                </a>
                <a href="#" data-reveal-id="myModal">
                    <img width="240px" src="<?php echo base_url('images/app_store_icon.png'); ?>">
                </a>
                </center>
        </div>
    </div>

    <div id="myModal" class="reveal-modal xlarge">
        <h2>Prochainement sur iOS + Android.</h2>
        <p class="lead">Un taxi depuis votre smartphone !</p>
        <p></p>
        <a class="close-reveal-modal">&#215;</a>
    </div>



