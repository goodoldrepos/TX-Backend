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

<script type="text/javascript">getMap(); //charger the map. </script>

<img class="banner" src="<?php echo base_url('images/halfcity.jpg'); ?>">
<br/>
<br/>

<div class="container">

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
        <tr>
          <td>Ville</td>
          <td>
            <?php echo $ville; ?></td>
        </tr>
        <tr>
          <td>Rue</td>
          <td>
            <?php echo $rue; ?></td>
        </tr>
        <tr>
          <td>Code Postale</td>
          <td>
            <?php echo $cp; ?></td>
        </tr>
        <tr>
          <td>Destination</td>
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
        <input type="button" class="btn btn-success" value="Confirmer" />
      </a>
      <a href="<?php echo site_url('reservations/annuler'); ?>
        ">
        <input type="button" class="btn" value="Annuler" />
      </a>
    </div>
  </div>

</div>