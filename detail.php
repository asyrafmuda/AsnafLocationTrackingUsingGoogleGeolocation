<?php 
$id = $_GET['id'];
include_once "ambildata_id.php";
$obj = json_decode($data);
$pname="";
$ptype="";
$pfamily="";
$pincome="";
$paddress="";
$pcity="";
$pstate="";
$platitude="";
$plongitude="";
$titles="";

foreach($obj->results as $item){
  $pname.=$item->name;
  $ptype.=$item->category;
  $pfamily.=$item->AsnafFamily;
  $pincome.=$item->AsnafIncome;
  
  
  $paddress.=$item->address;
  $pcity.=$item->AsnafCity;
  $pstate.=$item->AsnafState;
  $platitude.=$item->lat;
  $plongitude.=$item->lng;
  
}

$title = "Detail dan Lokasi : ".$titles;
include_once "header.php"; ?>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAbXF62gVyhJOVkRiTHcVp_BkjPYDQfH5w"></script>

<script>

function initialize() {
  var myLatlng = new google.maps.LatLng(<?php echo $platitude ?>,<?php echo $plongitude ?>);
  var mapOptions = {
    zoom: 10,
    center: myLatlng
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading"><?php echo $pname ?></h1>'+
      '<div id="bodyContent">'+
      '<p><?php echo $paddress ?></p>'+
      '</div>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Maps Info',
      icon:'img/marker.png'
  });
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
      <div class="row">
      <div class="col-md-5">
          <div class="panel panel-info panel-dashboard">
            <div class="panel-heading centered">
              <h2 class="panel-title"><strong> - Lokasi - </strong></h4>
            </div>
            <div class="panel-body">
              <div id="map-canvas" style="width:100%;height:380px;"></div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="panel panel-info panel-dashboard">
            <div class="panel-heading centered">
              <h2 class="panel-title"><strong> - Detail - </strong></h4>
            </div>
            <div class="panel-body">
             <table class="table">
               <tr>
                 <th>Item</th>
                 <th>Detail</th>
               </tr>
               <tr>
                 <td>Asnaf Name</td>
                 <td><h4><?php echo $pname ?></h4></td>
               </tr>
               <tr>
                 <td>Asnaf Type</td>
                 <td><h4><?php echo $ptype ?></h4></td>
               </tr>
               <tr>
                 <td>Asnaf Family</td>
                 <td><h4><?php echo $pfamily ?></h4></td>
               </tr>
               <tr>
                 <td>Asnaf Income</td>
                 <td><h4><?php echo $pincome ?></h4></td>
               </tr>
               <tr>
                 <td>Address</td>
                 <td><h4><?php echo $paddress ?></h4></td>
               </tr>
               <tr>
                 <td>City</td>
                 <td><h4><?php echo $pcity ?></h4></td>
               </tr>
               <tr>
                 <td>State</td>
                 <td><h4><?php echo $pstate ?></h4></td>
               </tr>
               <tr>
                 <td>Latitude</td>
                 <td><h4><?php echo $platitude ?></h4></td>
               </tr>
               <tr>
                 <td>Longitude</td>
                 <td><h4><?php echo $plongitude ?></h4></td>
               </tr>
               
             </table>
            </div>
            </div>
          </div>

        
        </div>
      </div>
    </div>
    <?php include_once "footer.php"; ?>