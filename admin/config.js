
config = {};

config.center = [2.27342294, 102.44516283, 12];

config.defaultPoint = {
	gmapsLatLng: [2.27342294, 102.44516283],  //will be converted manually to new google.maps.LatLng()
	'LOCATION_NAME': {value: 'My Home'}, 
	'ADDRESS': {value: 'Lipat Kajang'}
};

config.fusionTablesQuery = {
	select: '\'LOCATION_NAME\'',
	from: '1Mvf8QZQUJPuCalgGcchYUeIbraT-PtftYeRw9ee1'
};

// everything between <%= and %> is eval'd
config.cardHtmlTemplate = '<li class="card" data-index="<%= idx %>">'
		+ '<span class="handle" style="background-image:url(\'<%= iconUrl %>\')"></span>'
		+ '<b><%= getter("LOCATION_NAME") %></b> <a href="#">×</a><br>'
		+ 'Address: <%= getter("ADDRESS") %><br>'
		+ '<%= getter("YR_INSTALLED") + (getter("YR_INSTALLED") > 2010 ? "NEW" : "OLD") %>'
		+ '</li>';

