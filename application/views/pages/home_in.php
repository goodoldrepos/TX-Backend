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
<script type="text/javascript"> 

  $(document).ready(function(){

    var latitude = 33.5380426;
    var longitude = -7.6044972;

    var old_lat = 0;
    var old_long = 0;
    
    var map = new GMaps({
      el: '#basic_map',
      lat: latitude,
      lng: longitude
    });

    generateOutput();

    window.setInterval(function() { generateOutput(); }, 3000);
    
    function generateOutput(){
      $.get('fetch', function(data) {

        var val = data.split(" ");
        console.log(data);
        latitude = val[0];
        longitude = val[1];

        //latitude += 0.0005;
        //longitude += 0.0007;

        /*map = new GMaps({
          el: '#basic_map',
          lat: latitude,
          lng: longitude
          });*/

        map.removeMarkers(); 
        map.addMarker({
          lat: latitude,
          lng: longitude,
          title: 'Home',
          click: function(e) { alert('Vous êtes ici'); }
        }); 



      });
    }

    
  
    /*map.addMarker({
      lat: latitude,
      lng: longitude,
      title: 'Home',
      click: function(e) { alert('Vous etes ici'); }
    });*/

  });

  
</script>

<img src="<?php echo base_url() ?>images/halfcity.jpg">
<br/><br/>
<div class="row">
  <div class="twelve columns">
    <div id="basic_map" class="map"></div>
  </div>
</div>

<br/><br/>



<br/><br/>

<?php if(!reservation_encours($this->session->userdata('user_id'))){ ?>

<div class="row">
  <div class="twelve columns">
    <dl class="tabs">
      <dd class="active">
        <a href="#simple1">Demande immédiate</a>
      </dd>
      <dd>
        <a href="#simple2">Demande à l'avance</a>
      </dd>
    </dl>
    <ul class="tabs-content">
      <li class="active" id="simple1Tab">
        <?php echo form_open('reservations/immediate') ?>
        <div class="row">
          <div class="six columns">
            <label>Départ</label>
            <input type="text" name="ville" placeholder="Ville" />
            <input type="text" name="rue" placeholder="Rue" />
            <input type="text" name="code_postale" placeholder="CP" />
            <label>Destination</label>
            <input type="text" name="destination" placeholder="Rue" />
            <label>Nombre de passagers</label>
            <select name="nombre_passagers" >
              <option>1</option>
              <option>2</option>
            </select>
            <br/>
            <br/>
            <label>Nombre de bagages</label>
            <select name="nombre_bagages">
              <option>1</option>
              <option>2</option>
            </select>            
            <br/>
            <br/>
            <input type="submit" class="small button right" value="Continuer" >
            
            <br/>
            <br/>
          </div>
          <div class="six columns">
            
          </div>
          <?php echo form_close() ?>
        </div>

      </li>
      <li id="simple2Tab">
        <?php echo form_open('reservations/avance') ?>
        <div class="row">
          <div class="six columns">
            <label>Départ</label>
            <input type="text" placeholder="Ville" />
            <input type="text" placeholder="Rue" />
            <input type="text" placeholder="CP" />
            <label>Destination</label>
            <input type="text" placeholder="Rue" />
            <label>Nombre de passagers</label>
            <select>
              <option>1</option>
              <option>2</option>
            </select>
            <br/>
            <br/>
            <label>Nombre de bagages</label>
            <select>
              <option>1</option>
              <option>2</option>
            </select>
            <br/><br/>
            <div class="row">
              <div class="six columns">
                <input type="text" placeholder="Date" />
              </div>
              <div class="three columns">
                <input type="text" placeholder="Heure" />
              </div>
              <div class="three columns">
                <input type="text" placeholder="Minute" />
              </div>
            </div>
            <br/>
            <input type="submit" class="small button right" value="Continuer" > 
            <br/>
            <br/>
          </div>
          <div class="six columns">
            
          </div>
          <?php echo form_close() ?>
        </div>

      </li>
    </ul>
  </div>
</div>

<?php }else{ ?>
  <div class="row">
    <div class="twelve columns">
      <div class="alert-box success">
          Votre taxi est en route. Vous allez recevoir une confirmation par email d'ici quelques instants.  
        <a href="" class="close">&times;</a>
      </div>
    </div>
  </div>
  
<?php } ?>

<script type="text/javascript">
$(document).foundationTabs();
$(document).foundationAlerts();
</script>