

	<style type="text/css">

    	.formulaire{
    		width:300px;
    		position: relative;
    		padding: 15px;

    		bottom:350px;
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
    	

		.features{
			position:relative;
			bottom:350px;
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

        .error{
            color:red;
        }
    </style>

    <img class="banner" src="<?php echo base_url('images/paris.jpg'); ?>" />

    
    <div class="formulaire" >
    	<?php echo validation_errors(); ?>
    	<?php echo form_open('reservations/immediate', array('id' => 'reservationForm')) ?>
			<label>Départ</label>
				<input type="text" class="required input-block-level" class="required" name="depart" placeholder="Saisir l'adresse de départ ..." />				
			<label>Destination</label>
			<input type="text" class="required input-block-level" name="destination" placeholder="Saisir l'adresse de destionation ..." />	
			<label>Nombre de passagers</label>
			<select name="nombre_passagers" class="input-block-level">
				<option name="1" >1</option>
				<option name="2" >2</option>
			</select>
			<label>Nombre de bagages</label>
			<select name="nombre_bagages" class="input-block-level" >
				<option name="1" >1</option>
				<option name="2" >2</option>
			</select>
			<input type="submit" class="btn btn-block btn-success " value="Continuer" >
			<?php echo form_close() ?>
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
        $("#reservationForm").validate();
    });
</script>

<div class="container">

    <div class="row features">
        <div class="row reasons">
            <div class="span12">
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
    	<div class="span4 feature">
            <div class="well well-small">
    		<center>
    			<h4>Où que vous soyez</h4>
    			<img src="<?php echo base_url('images/phone.png'); ?>">
    			<p class="feature_text">
    			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in leo ipsum, id pretium lectus. Mauris at adipiscing urna. Proin id nulla nulla, nec fringilla velit. 
    			</p>
    		</center>
            </div>
    	</div>
    	<div class="span4 feature">
            <div class="well well-small">
    		<center>
    			<h4>Payer par carte</h4>
    			<img src="<?php echo base_url('images/card.png'); ?>">
    			<p>
    			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in leo ipsum, id pretium lectus. Mauris at adipiscing urna. Proin id nulla nulla, nec fringilla velit. 
    			</p>
    		</center>
            </div>
    	</div>
    	<div class="span4 feature">
            <div class="well well-small">
    		<center>
    			<h4>Soyez en sécurité</h4>
    			<img src="<?php echo base_url('images/taxi.png'); ?>">
    			<p>
    			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in leo ipsum, id pretium lectus. Mauris at adipiscing urna. Proin id nulla nulla, nec fringilla velit. 
    			</p>
    		</center>
            </div>
    	</div>
    </div>

    <div class="row tarifs">
        <div class="span12">
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
        <div class="span12">
            <div id="linebreak"></div>
                <center>
                <h2><span class="purple">Un taxi depuis votre smartphone.</span></h2>
                <h3><small>- Téléchargement gratuit - </small> </h3>
                <br/>
                <a href="#">
                    <img width="200px" src="<?php echo base_url('images/google_play_icon.png'); ?>" >
                </a>
                <a href="#">
                    <img width="240px" src="<?php echo base_url('images/app_store_icon.png'); ?>" >
                </a>
                </center>
        </div>
    </div>

</div>

    <div class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Modal header</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn">Close</a>
    <a href="#" class="btn btn-primary">Save changes</a>
  </div>
    </div>

    





