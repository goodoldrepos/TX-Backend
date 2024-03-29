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

<script type="text/javascript">getMap("all"); //charger the map. </script>

<img class="banner" src="<?php echo base_url('images/halfcity.jpg'); ?>">
<br/>
<br/>

<div class="container">

    <div class="row">
        <div class="span12">
            <div class="page-header">
                <h1>Valider la commande</h1>
            </div>
        </div>
    </div>

  <div class="row">
    <div class="span12">
      <div id="basic_map" class="map"></div>
    </div>
  </div>

  <br/>
  <br/>

  <div class="row">
    <div class="span6">
      <table class="table">
          <h1><small>Informations sur votre commande</small></h1>
        <tr>
          <td>Adresse de départ</td>
          <td>
            <?php echo $depart; ?></td>
        </tr>
        <tr>
          <td>Adresse de destination</td>
          <td>
            <?php echo $destination; ?></td>
        </tr>
        <tr>
          <td>Nombre de passagers</td>
          <td>
            <?php echo $passagers; ?></td>
        </tr>
        <tr>
          <td>Nombre de bagages</td>
          <td>
            <?php echo $bagages; ?></td>
        </tr>
      </table>
      <br/>
      <a href="<?php echo site_url('reservations/process_immediate'); ?>
        ">
        <input type="button" class="btn btn-success" value="Confirmer la commande" />
      </a>
      <a href="<?php echo site_url('reservations/annuler'); ?>
        ">
        <input type="button" class="btn" value="Annuler" />
      </a>
    </div>
  </div>

</div>
<br/>