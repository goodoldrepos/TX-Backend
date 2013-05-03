function getMap(mode){
        
    var rendered = false;

    fetchClient(); 
    window.setInterval(function() { fetchClient(); }, 10000);

    

    function fetchClient(){
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

        map.removeMarkers();


        if(latitude != -10 && longitude != -10){
          map.addMarker({
          lat: latitude,
          lng: longitude,
          title: 'Home',
          click: function(e) { alert('Vous êtes ici!'); }
          }); 
          console.log("IN");
        }

        fetchChauffeurs();

      });
    }

    function fetchChauffeurs(){
      $.get('/tx/index.php/pages/fetchChauffeurs', function(data) {

        var obj = jQuery.parseJSON(data);

        console.log(data);

        map.removeOverlays();

        if(mode == "all"){
          for(var j=0; j< obj.length;j++){
            map.drawOverlay({
            lat: obj[j].latitude,
            lng: obj[j].longitude,
            content: '<img src="http://png-5.findicons.com/files/icons/951/google_maps/32/taxi.png" />'
            });  
          } 
        }else if(mode == "nearest"){
          for(var j=0; j< obj.length;j++){
            if(obj[j].distance < 10){
              map.drawOverlay({
              lat: obj[j].latitude,
              lng: obj[j].longitude,
              content: '<img src="http://png-5.findicons.com/files/icons/951/google_maps/32/taxi.png" />'
              });
            }else{
              map.drawOverlay({
              lat: obj[j].latitude,
              lng: obj[j].longitude,
              content: '<img src="http://images1.makemytrip.com/mmtimgs/RP/images/airline-logo/car.png" />'
              });  
            }
          }  
        }  

      });
    }
  
}
    
  


    
