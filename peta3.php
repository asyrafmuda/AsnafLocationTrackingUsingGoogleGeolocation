<html>
<head>
    <title>HVC Hotel Locator</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css"/>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDa5YXrPw8xOmJyAP2nvqss-CVwVjMiLnw&libraries=places"></script>  
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div >

                <div class="search">

                   <label>Locate nearest Asnaf</label>
                   <input type="text" id="txtAddress" class="form-control text" style="margin-bottom: 10px;" value="Jasin Malacca Malaysia"/>
                   <button id="btnSearch" class= "btn btn-info">Get Locations</button>

                 

                    
                </div> 

                 <div class=" map" id="map" ></div>

            </div>


            <label>List of Nearest Asnaf</label>
           <div id="locations"></div>

            
        </div>
     </div>
    <script type="text/javascript" src="js/locator.js"></script>    
</body>
</html>