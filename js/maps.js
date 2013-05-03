function getMap(){
        
    var rendered = false;

    fetch();
    
    window.setInterval(function() { fetch(); }, 5000);
    

    function fetch(){
      $.get('/tx/index.php/pages/fetchClient', function(data) {

        var val = data.split(" ");
        latitude = val[0];
        longitude = val[1];

        if(!rendered){
          if(latitude == -10 && longitude == -10){
            lat = 48.858278;
            long = 2.294254;
          }else{
            lat = latitude;
            long = longitude; 
          }


          map = new GMaps({
            el: '#basic_map',
            lat: lat,
            lng: long
          });
          rendered = true; //map already rendered
        }
        


        if(latitude != -10 && longitude != -10){
          map.addMarker({
          lat: latitude,
          lng: longitude,
          title: 'Home',
          click: function(e) { alert('Vous êtes ici!'); }
          }); 
        }
        

      });

      $.get('/tx/index.php/pages/fetchChauffeurs', function(data) {

        var obj = jQuery.parseJSON(data);

        map.removeMarkers();
        map.removeOverlays();

        for(var j=0; j< obj.length;j++){
          if(obj[j].distance < 10){
            map.drawOverlay({
            lat: obj[j].latitude,
            lng: obj[j].longitude,
            content: '<img src="http://www.certh.gr/img/icon_taxi-y.gif" />'
            });
          }else{
            map.drawOverlay({
            lat: obj[j].latitude,
            lng: obj[j].longitude,
            content: '<img src="http://images1.makemytrip.com/mmtimgs/RP/images/airline-logo/car.png" />'
            });  
          }
        }

        console.log(data);

        if(latitude != -10 && longitude != -10){
          map.addMarker({
          lat: latitude,
          lng: longitude,
          title: 'Home',
          click: function(e) { alert('Vous êtes ici!'); }
          }); 
        }

      });


    }
    
    

    
    
  
    /*map.addMarker({
      lat: latitude,
      lng: longitude,
      title: 'Home',
      click: function(e) { alert('Vous etes ici'); }
    });*/
  
}

    
