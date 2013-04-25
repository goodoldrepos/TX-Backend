<style type="text/css">
.map {
  display: block;
  width: 100%;
  height: 200px;
  margin: 0 auto;
  -webkit-box-shadow: 6px 5px 7px rgba(50, 50, 50, 0.26);
  -moz-box-shadow:    6px 5px 7px rgba(50, 50, 50, 0.26);
  box-shadow:         6px 5px 7px rgba(50, 50, 50, 0.26);
}

</style>

<img class="banner" src="<?php echo base_url('images/halfcity.jpg '); ?>">
<br/>
<br/>

<script type="text/javascript">getMap(); //charger the map. </script>

<div class="container">

  <div class="row">
    <div class="span12">
      <div id="basic_map" class="map"></div>
    </div>
  </div>

  <br/>
  <br/>

  <?php if(!reservation_encours($this->session->userdata('user_id'))){ ?>
  <div class="row">
    <div class="span12">
  <div class="tabbable">
    <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#tab1" data-toggle="tab">Taxi Immédiat</a>
      </li>
      <li>
        <a href="#tab2" data-toggle="tab">Demande à l'avance</a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab1">
        <div class="row">
          <div class="span5">
            <?php echo form_open('reservations/immediate') ?>
            <label>Départ</label>
            <input type="text" class="required input-block-level"name="depart" placeholder="Adresse de départ" />
            <label>Destination</label>
            <input type="text" class="required input-block-level" name="destination" placeholder="Adresse de destination" />
            <label>Nombre de passagers</label>
            <select name="nombre_passagers" class="input-block-level" >
              <option>1</option>
              <option>2</option>
            </select>
            <label>Nombre de bagages</label>
            <select name="nombre_bagages" class="input-block-level" >
              <option>1</option>
              <option>2</option>
            </select>
            <br/>
            <input type="submit" class="btn btn-success" value="Continuer" >
            <?php echo form_close() ?></div>
        </div>
      </div>
      <div class="tab-pane" id="tab2">
        <p>Prochainement.</p>
      </div>
    </div>
  </div>
  </div>
  </div>

  <?php }else{ ?>

  <div class="row">
      <div class="span12">
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      Votre taxi est en route ! Vous allez recevoir une confirmation par e-mail d'ici quelques minutes.
    </div>
  </div>
  </div>
  


  <?php } ?>

</div>