function getMap(){
    
    var latitude = 48.85902;
    var longitude = 2.29332;
    
    /*var map = new GMaps({
      el: '#basic_map',
      lat: latitude,
      lng: longitude
    });*/

    var rendered = false;

    fetch();
    
    window.setInterval(function() { fetch(); }, 5000);
    

    function fetch(){
      $.get('/tx/index.php/pages/fetchClient', function(data) {

        var val = data.split(" ");
        console.log("Client: " + data);
        latitude = val[0];
        longitude = val[1];

        if(!rendered){
          map = new GMaps({
          el: '#basic_map',
          lat: latitude,
          lng: longitude
          });
          rendered = true;
        }
        
        map.addMarker({
          lat: latitude,
          lng: longitude,
          title: 'Home',
          click: function(e) { alert('Vous êtes ici!'); }
        }); 

      });

      $.get('/tx/index.php/pages/fetchChauffeurs', function(data) {

        //var val = data.split(" ");
        console.log("Chauffeurs: " + data);

        var obj = jQuery.parseJSON(data);

        map.removeMarkers();
        map.removeOverlays();

        for(var j=0; j<obj.length;j++){
          map.drawOverlay({
          lat: obj[j].latitude,
          lng: obj[j].longitude,
          content: '<img src="http://www.certh.gr/img/icon_taxi-y.gif" />'
          });
        }

        map.addMarker({
          lat: latitude,
          lng: longitude,
          title: 'Home',
          click: function(e) { alert('Vous êtes ici!'); }
        });

      });


    }
    
    

    
    
  
    /*map.addMarker({
      lat: latitude,
      lng: longitude,
      title: 'Home',
      click: function(e) { alert('Vous etes ici'); }
    });*/
  
}

    
