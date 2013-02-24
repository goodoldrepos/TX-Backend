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

body{
  background: #eeeeee; /* Old browsers */
  background: -moz-linear-gradient(top, #eeeeee 0%, #eeeeee 100%); /* FF3.6+ */
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#eeeeee)); /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(top, #eeeeee 0%,#eeeeee 100%); /* Chrome10+,Safari5.1+ */
  background: -o-linear-gradient(top, #eeeeee 0%,#eeeeee 100%); /* Opera 11.10+ */
  background: -ms-linear-gradient(top, #eeeeee 0%,#eeeeee 100%); /* IE10+ */
  background: linear-gradient(to bottom, #eeeeee 0%,#eeeeee 100%); /* W3C */
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#eeeeee',GradientType=0 ); /* IE6-9 */
}

</style>

<img src="<?php echo base_url() ?>images/halfcity.jpg">
<br/><br/>
<div class="row">
  <div class="twelve columns">
    <div id="basic_map" class="map"></div>
  </div>
</div>

<br/><br/>


<div class="row">
  <div class="twelve columns">
    <?php if($this->session->userdata('reservation')){
      echo "Reservation en cours. <a href=" . site_url('reservations/annuler') . ">Annuler</a>";
    } ?>
  </div>
</div>


<br/><br/>

<div class="row">
  <div class="twelve columns">
    <table>
      <tr>
        <td>Ville</td>
        <td><?php echo $ville; ?></td>
      </tr>
      <tr>
        <td>Rue</td>
        <td><?php echo $rue; ?></td>
      </tr>
      <tr>
        <td>Code Postale</td>
        <td><?php echo $cp; ?></td>
      </tr>
      <tr>
        <td>Destination</td>
        <td><?php echo $destination; ?></td>
      </tr>
      <tr>
        <td>Nombre de passagers</td>
        <td><?php echo $passagers; ?></td>
      </tr>
      <tr>
        <td>Nombre de bagages</td>
        <td><?php echo $bagages; ?></td>
      </tr>
    </table>
    <br/>
    <a href="<?php echo site_url('reservations/process_immediate'); ?>">
      <input type="button" class="button" value="Confirmer" />
    </a>
    <input type="button" class="button" value="Modifier" />
    
  </div>
</div>