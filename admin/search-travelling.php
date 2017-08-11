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

<<style>
	html, body, #map-canvas {
		height: 100%;
		margin: 0px;
		padding: 0px;
		font-family: Roboto, Arial, sans-serif;
	}

	a {
		text-decoration: none;
		color: red;
		padding: 0 0.3em
	}

	.opaque-zoom img[src*='googleapis.com/mapslt'] {
		opacity: 0.4
	}

	ul {
		list-style-type: none
	}

	ul, ul li {
		padding: 0;
		margin: 0
	}

	.card {
		border: 1px silver solid;
		font-size: 80%;
		padding: 0.3em;
		background: #fff;
		position: relative;

	}

	.card b {
		font-size: 110%
	}

	.card .handle {
		position: absolute;
		right: 3px;
		top: 3px;
		width: 40px;
		height: 40px;
		cursor: move;
		background: no-repeat right top;
	}

	.card .handle:hover {
		background-color: rgba(255, 236, 19, 0.20)
	}

	.route {
		font-size: 80%;
		color: gray;
		padding-left: 3em
	}

	#map-canvas {
		width: 70%
	}

	#total {
		padding: 1em;
		font-size: 160%;
		text-align: center;
		background: #fbb450 url(logo.png) no-repeat right center
	}

	#right-panel {
		position: absolute;
		top: 170px;
		right: 0;
		width: 30%;
		height: 100%;
		overflow: scroll
	}

	@media print {
		#map-canvas {
			display: none;
		}

		#right-panel {
			position: static;
			width: 70%;
			overflow: auto;
			height: auto;
		}
	}

</style>

<style type='text/css'>
.center {
    text-align:center;
}
</style>

</head> 
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAbXF62gVyhJOVkRiTHcVp_BkjPYDQfH5w"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css"/> -->
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
<script src="config.js"></script>

<body>
   <div class="page-container">

<!--header start here-->
<?php include('includes/header.php');?>
	   
   <!--/content-inner-->
<ol class="breadcrumb">
                <center><a href="index.html">Travelling Salesman Algorithm Searching</a> </center>
            </ol>

<div id="map-canvas"></div>
<div id="total">&nbsp;</div>
<div id="right-panel">
	

	<div style="padding: 0.5em 1em 0 1em;">
		<ul id="places"></ul>

		<p>Click a red point in map</p>

		<p>The Traveling Salesman Problem is one of the most famous problems in computer science. In what follows, we'll describe the problem and show you how to find a solution..</p>

		<p>The Traveling Salesman Problem is one of the best solution to solve if the zakat management want to give a contribution to the asnaf. So by using TSP algo, will know the shortest path and distance all route . Save time, save fuel</p>


		
		<p><a href="https://fusiontables.google.com/DataSource?docid=" id="source-table" title="Google Fusion Table">Source data table</a></p>
	</div>

	<div id="directionsPanel" style="padding: 1em;"></div>
</div>

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
// Travelling salesman for Google Fusion Tables
// https://github.com/zbycz/fusion-salesman
//
// (c) 2014 [Pavel Zbytovský](http://zby.cz)
// Licenced under MIT license.
//

var map, layer;
var cache = {}; // cache for directions outputs between single [route] points. Key is string "$origin$destination"
var directionsService = new google.maps.DirectionsService();

// default Route to show
var route = [];
var defaultPoint = config.defaultPoint;
	defaultPoint.gmapsLatLng = new google.maps.LatLng(defaultPoint.gmapsLatLng[0], defaultPoint.gmapsLatLng[1]);
route.push(defaultPoint);
route.push(defaultPoint);

/** Init click listener and find first route.
 * On window load.
 */
function initialize() {
	//add link to source table
	var sourceLink = document.getElementById('source-table');
	sourceLink.href += config.fusionTablesQuery.from;

	//init map canvas
	map = new google.maps.Map(document.getElementById('map-canvas'), {
		center: new google.maps.LatLng(config.center[0], config.center[1]),
		zoom: config.center[2]
	});

	// add layer with FusionTables points
	layer = new google.maps.FusionTablesLayer({
		query: config.fusionTablesQuery,
		suppressInfoWindows: true
	});
	layer.setMap(map);

	// click event on FusionTables point [typeof event == {latLng: U, pixelOffset: W, row: Object, infoWindowHtml: string}]
	google.maps.event.addListener(layer, 'click', function (event) {
		var row = event.row;
		row.gmapsLatLng = event.latLng;
		console.log('Clicked', row);

		if (route.length && route[route.length - 1] == defaultPoint)
			route.splice(route.length - 1, 0, row);
		else
			route.push(row);
		findAllRoutes();
	});

	// opaque FusionTables points on smaller zooms
	google.maps.event.addListener(map, 'zoom_changed', function () {
		console.log('zoom:' + map.getZoom());
		if (map.getZoom() >= 12)
			$('body').removeClass('opaque-zoom');
		else
			$('body').addClass('opaque-zoom');
	});

	findAllRoutes();
}

/** Iterates through all routes and calls getDirection() if cache missed
 */
function findAllRoutes() {
	//invalidate cache
	for (var key in cache) {
		cache[key].used = 0;
	}

	// find all routes
	var cur, prev = route[0];
	for (i = 1; i < route.length; i++) {
		cur = route[i];

		var obj = getDirections(prev.gmapsLatLng, cur.gmapsLatLng);
		obj.marker.setIcon(getIconUrl(i));

		prev = cur;
	}

	//hide&remove obsolete displayed items
	for (var key in cache) {
		if (cache[key].used == 0)
			hideAndRemoveCacheItem(key);
	}

	//write overview before requests + also when all requests are done
	writeOverview();
}

/** Main working function - calls google maps api
 */
function getDirections(origin, destination) {

	// look for a cache - then just use it
	var cacheKey = origin.toString() + destination.toString();
	if (cache[cacheKey]) {
		cache[cacheKey].used = 1;
		return cache[cacheKey];
	}

	// find new directions
	var obj = {
		used: 1,
		directionsDisplay: new google.maps.DirectionsRenderer({draggable: true, preserveViewport: true, suppressMarkers: true, map: map}),
		response: false,
		marker: new google.maps.Marker()
	};

	// on drag&drop route
	google.maps.event.addListener(obj.directionsDisplay, 'directions_changed', function () {
		writeOverview();
	});

	//send request
	var request = {
		origin: origin,
		destination: destination,
		travelMode: google.maps.TravelMode.DRIVING
	};

	directionsService.route(request, function (response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			obj.directionsDisplay.setDirections(response);
			obj.response = response;
			obj.marker.setPosition(response.routes[0].legs[0].start_location);
			obj.marker.setTitle(response.routes[0].legs[0].start_address);
			obj.marker.setMap(map);

			//when all requests are finished, write overview!
			var finished = true;
			for (var key in cache) if (!cache[key].response) finished = false;
			if (finished) writeOverview()
		}
	});

	cache[cacheKey] = obj;
	return obj;
}



/** Fill the right panel cards
 */
function writeOverview() {
	var ul = $('#places').empty();

	for (var i = 0; i < route.length; i++) {
		var row = route[i];
		ul.append(template({
			idx: i,
			iconUrl: getIconUrl(i + 1),
			row: row,
			getter: function(key){ //graceful getter
				return row[key] ? row[key].value : "";
			}
		}));

		// write route details
		if (i < route.length - 1) {
			var key = route[i].gmapsLatLng.toString() + route[i + 1].gmapsLatLng.toString();
			var rt = cache[key];

			ul.append('<li class="route">|- ' + getTotals(rt)
					+ (rt.response && rt.directionsDisplay.getDirections().routes[0].legs[0].via_waypoints.length ? ' <a href="#" data-cachekey="' + key + '">reset route between</a>' : '')
					+ '</li>');
		}
	}

	$('#places').sortable({
		items: '.card',
		placeholder: "ui-state-highlight",
		handle: ".handle",
		forceHelperSize: true,
		stop: function (event, ui) {
			var newOrder = $('#places').sortable('toArray', {attribute: 'data-index'});
			var newRoute = [];
			for (var i = 0; i < newOrder.length; i++) {
				newRoute.push(route[newOrder[i]]);
			}
			route = newRoute;
			findAllRoutes();
		}});


	$('#places a').click(function () {
		if (this.innerHTML.match(/×/))
			route.splice(this.parentNode.getAttribute('data-index'), 1);
		else
			hideAndRemoveCacheItem(this.getAttribute('data-cachekey'));
		findAllRoutes();
	});

	$('#total').html(getTotals('global'));
}

// -------------------------------------------------- Helpers --------------------------------------------------


/** Helper for 'remove button'
 */
function hideAndRemoveCacheItem(key) {
	if (cache[key]) {
		cache[key].directionsDisplay.setMap(null);
		cache[key].directionsDisplay = null;
		cache[key].marker.setMap(null);
		cache[key].marker = null;
		delete cache[key];
	}
}


/** The shortest templating system - eval everyting between <%= and %>
 */
function template(vars) {
	return config.cardHtmlTemplate.replace(/<\%=(.*?)\%>/gm, function(match, code){
		for(var k in vars) this[k] = vars[k];
		return eval(code);
	});
}

/** Helper for icon url (in template & in map)
 */
function getIconUrl(number) {
	return 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + number + '|990000|FFFFFF'; //FE6256|000000
	//text icon: 'http://chart.apis.google.com/chart?chst=d_map_spin&chld=1|0|FF0000|12|_|foo',
}

/** Returns distance+duration for route
 * @param Object|string oneRoute a cache-item for single || string 'global' for total sum
 * @return string ie. "195 km / 2:30h"
 */
function getTotals(oneRoute) {
	var total = 0;
	var duration = 0;
	var iterator = (oneRoute == 'global') ? cache : {1: oneRoute};

	for (var key in iterator) {
		var myroute = iterator[key].directionsDisplay.getDirections();
		if (!myroute)
			continue;

		myroute = myroute.routes[0];
		for (var i = 0; i < myroute.legs.length; i++) {
			total += myroute.legs[i].distance.value;
			duration += myroute.legs[i].duration.value;
		}
	}

	total = Math.round(total / 1000.0);
	duration = Math.round(duration / 60.0);
	var hours = Math.floor(duration / 60.0);
	var minutes = duration - hours * 60;
	if (minutes < 10) minutes = '0' + minutes;
	return total + ' km / ' + hours + ':' + minutes + 'h';
}


google.maps.event.addDomListener(window, 'load', initialize);

</script>
</body>
</html>
<?php } ?>