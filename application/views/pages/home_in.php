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

<script type="text/javascript">
  getMap(); //charger the map. 
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
            <input type="text" name="code_postale" placeholder="Code Postale" />
            <label>Destination</label>
            <input type="text" name="destination" placeholder="Adresse" />
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
