<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Web | Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->

<style>
html, body, #map-canvas {
	width: 100%;
	height: 100%;
	//margin:0px;
	//padding:0px
}

</style>

<style type='text/css'>
.center {
    text-align:center;
}
</style>

</head> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAbXF62gVyhJOVkRiTHcVp_BkjPYDQfH5w"></script>

<body>
   <div class="page-container">

<!--header start here-->
<?php include('includes/header.php');?>
	   
   <!--/content-inner-->
<ol class="breadcrumb">
                <center><a href="index.html">Djistrak Algorithm Searching</a> </center>
            </ol>

<?php
include "Main.php";



// koneksi
$m = new Main();
$koneksi = $m->koneksi;

// query
$sql 	= "SELECT * FROM infoasnaf";
$query 	= mysqli_query($koneksi, $sql);



// select option

echo 'TUJUAN : <select id="select_tujuan" onchange="choose_destination(this.value)">';
echo '<option value="pilih">-- PILIH --</option>';
	while($fetch = mysqli_fetch_array($query, MYSQLI_ASSOC))
	{
		$koordinat 		= $fetch['koordinat'];
		$exp_koordinat 	= explode(',', $koordinat);
		$json_koordinat	= '{"lat": '.$exp_koordinat[0].', "lng": '.$exp_koordinat[1].'}';
		
		echo "<option value='$json_koordinat'>$fetch[tujuan]</option>";
	}
echo '</select>';
?>
<span><button onclick="send_dijkstra()" id='run_dijkstra'>RUN</button><span id='loading' style='display:none'>membuat route ..</span></span>

<div id="map-canvas" style="float:left;"></div>
<div id='DEBUG'></div>

			<!--/sidebar-menu-->
				<?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   
<!-- morris JavaScript -->	
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2014 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2014 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2014 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2014 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2015 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2015 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2015 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2015 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2016 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
				{period: '2016 Q2', iphone: 8442, ipad: 5723, itouch: 1801}
			],
			lineColors:['#ff4a43','#a2d200','#22beef'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
	<script>
// map
var poly = '';
var map;
var markeruser = '';
var markerdestination = '';

// boolean
var __global_user		 = false;
var __global_destination = false;
var update_timeout;

// temporary list angkot
var temp_list_angkot = [];

/**
* INITIALIZE GOOGLE MAP
*/
function initialize() {	
	/* setup map */
	var mapOptions = {
		zoom: 13,
		center: new google.maps.LatLng(2.2737, 102.4430)
	};
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  
	/* create marker and line by click */
	google.maps.event.addListener(map, 'click', function(event) 
	{	
		icons = 'http://latcoding.com/domains/dijkstra.latcoding.com/imgs/user_min.png';
		var location = event.latLng;	

		update_timeout = setTimeout(function()
		{
			if(__global_user == false){
				markeruser = new google.maps.Marker({
					position: location,
					map: map,
					icon: icons,
					draggable: true,
					title: 'test drag',
				});
				
				// update 
				__global_user = true;
			}else{
				markeruser.setPosition(location);
			}

		}, 200); 

	});	

	// handle click and dblclick same time
	google.maps.event.addListener(map, 'dblclick', function(event) {       
		clearTimeout(update_timeout);
	});	
}

/** 
* PILIH DESTINATION (SEKOLAH) VIA <SELECT>
*/
function choose_destination(value){
	// teks option
	var teks = $("#select_tujuan option:selected").text();
	
	// -- PILIH -- dipilih
	if(value == 'pilih') return false;
	
	// reset polyline
	if(poly != '') poly.setMap(null);
	
	// RESET ANGKOT SEBELUMNYA
	$(temp_list_angkot).each(function(w, x){
		// x = marker0, marker1 dst
		window[x].setMap(null);
	});			
	
	var location = JSON.parse(value);
	icons = 'http://latcoding.com/domains/dijkstra.latcoding.com/imgs/school_24.png';
	
	if(__global_destination == false){
		markerdestination = new google.maps.Marker({
			position: location,
			map: map,
			icon: icons,
			draggable: false,
			title: 'TUJUAN : ' + teks,
		});
		
		__global_destination = true;
	}else{
		markerdestination.setPosition(location);
		markerdestination.setTitle('TUJUAN : ' + teks);
	}
}

/**
* GET JSON DIJSKTRA VIA AJAX
*/
function send_dijkstra(){
	
	if(markeruser == '' || markerdestination == ''){
		alert('Isi dulu koordinat user & tujuan');
		return false;
	}
	
	console.log(markeruser.position.lat());
	console.log(markeruser.position.lng());
	now_koord_user 			= '{"lat": ' + markeruser.position.lat() + ', "lng": ' + markeruser.position.lng() + '}';
	now_koord_destination 	= '{"lat": ' + markerdestination.position.lat() + ', "lng": ' + markerdestination.position.lng() + '}';

	// loading
	$('#run_dijkstra').hide();
	$('#loading').show();
	
	$.ajax({
		method:"POST",
		url : "Main.php",
		data: {koord_user: now_koord_user, koord_destination: now_koord_destination},
		success:function(response){
			
			// remove loading
			$('#run_dijkstra').show();
			$('#loading').hide();
						
			var json = JSON.parse(response);
			console.log(response);
			
			// RESET POLYLINE
			if(poly != '') poly.setMap(null);
			
			// RESET ANGKOT SEBELUMNYA
			$(temp_list_angkot).each(function(w, x){
				// x = marker0, marker1 dst
				window[x].setMap(null);
			});

			// ERROR ALGORITMA DIJKSTRA
			if(json.hasOwnProperty("error")) alert(json['error']['teks']);
			
			// GAMBAR JALUR SHORTEST PATH
			/* setup polyline */
			var polyOptions = {				
				/*path: [
				{"lat": 37.772, "lng": -122.214},
				{"lat": 21.291, "lng": -157.821},
				{"lat": -18.142, "lng": 178.431},
				{"lat": -27.467, "lng": 153.027}],
				*/
				path: json['jalur_shortest_path'],
				geodesic: true,
				strokeColor: 'rgb(20, 120, 218)',
				strokeOpacity: 1.0,
				strokeWeight: 2,
			};			
			poly = new google.maps.Polyline(polyOptions);
			poly.setMap(map);
			
			// GAMBAR KOORDINAT ANGKOT
			$(json['angkot']).each(function(i, v)
			{
				// no_angkot
				no_angkot = JSON.stringify(v['no_angkot']);
				window['infowindow'+i] = new google.maps.InfoWindow({
					content: '<div>'+ no_angkot +'</div>'
				});
				
				// koordinat angkot
				koordinat_angkot = v['koordinat_angkot'];
				window['marker'+i] = new google.maps.Marker({
					position: koordinat_angkot,
					map: map,
					title: 'title',
					icon: 'http://latcoding.com/free_download/implementasi_dijkstra_di_android/car.png'
				});
				
				// popup
				window['marker'+i].addListener('click', function() {
					window['infowindow'+i].open(map, window['marker'+i]);
				});
				
				// temporary list angkot
				temp_list_angkot[i] = 'marker'+i;
			});
		},
		error:function(er){
			alert('error: '+er);
			
			// remove loading
			$('#run_dijkstra').show();
			$('#loading').hide();
		}
	});	
}

/* load google maps v3 */
google.maps.event.addDomListener(window, 'load', initialize);
</script>
</body>
</html>
<?php } ?>