<?php
$title = "Sistem Informasi Asnaf";
include_once "header.php";
?>

      <div class="row">

        <div class="col-md-12">
          <div class="panel panel-info panel-dashboard centered">
            <div class="panel-heading">
              <h2 class="panel-title"><strong> - TAMPILAN PETA - </strong></h2>
            </div>
            <div class="panel-body">
              <div id="map" style="width:100%;height:380px;"></div>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAbXF62gVyhJOVkRiTHcVp_BkjPYDQfH5w"></script>
<script src="https://chadkillingsworth.github.io/geolocation-marker/geolocation-marker.js"></script>


<script type="text/javascript">
   var map, GeoMarker; 
  

  function initialize() {
    
    var mapOptions = {   
        zoom: 10,
        center: new google.maps.LatLng(4.6360, 102.4069), 
        disableDefaultUI: true
    };

    var mapElement = document.getElementById('map');

    var map = new google.maps.Map(mapElement, mapOptions);

    setMarkers(map, officeLocations);

    GeoMarker = new GeolocationMarker();
        GeoMarker.setCircleOptions({fillColor: '#808080'});

        google.maps.event.addListenerOnce(GeoMarker, 'position_changed', function() {
          map.setCenter(this.getPosition());
          map.fitBounds(this.getBounds());
        });

       google.maps.event.addListener(GeoMarker, 'geolocation_error', function(e) {
          alert('There was an error obtaining your position. Message: ' + e.message);
        });

        GeoMarker.setMap(map);

              
}


var officeLocations = [
<?php
$data = file_get_contents('http://localhost/web/ambildata.php');
                $no=1;
                if(json_decode($data,true)){
                  $obj = json_decode($data);
                  foreach($obj->results as $item){
?>
[<?php echo $item->id ?>,'<?php echo $item->name ?>','<?php echo $item->address ?>', <?php echo $item->lng ?>, <?php echo $item->lat ?>],
<?php 
}
} 
?>    
];


function setMarkers(map, locations)
{
    var globalPin = 'img/marker.png';

    for (var i = 0; i < locations.length; i++) {
       
        var office = locations[i];
        var myLatLng = new google.maps.LatLng(office[4], office[3]);
        var infowindow = new google.maps.InfoWindow({content: contentString});
         
        var contentString = 
            '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h5 id="firstHeading" class="firstHeading">'+ office[1] + '</h5>'+
            '<div id="bodyContent">'+ 
            '<a href=detail.php?id='+office[0]+'>Info Detail</a>'+'|'+
            '</div>'+
            '</div>';

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            Mike: infowindow,
            title: office[1],
            icon:'img/marker.png'
        });

               

        google.maps.event.addListener(marker, 'click', getInfoCallback(map, contentString));


    }
}

function getInfoCallback(map, content) {
    var infowindow = new google.maps.InfoWindow({content: content});
    return function() {
            infowindow.setContent(content); 
            infowindow.open(map, this);
        };


}

initialize();
</script>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
<?php include_once "footer.php"; ?>