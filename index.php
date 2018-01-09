
<html lang="en">
	<head>
		<title>HussainMaps</title>
		<link rel="icon" type="image/jpg" href="img/glo.jpg">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<link rel="stylesheet" href="css/map.css">
		
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
		<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyB5bh-Wqv3OCmSSHW3vC81FmnlNC0huEVA&sensor=false&libraries=places" type="text/javascript"></script>	
		<style>
			.w3-spin {
			animation: w3-spin 0.8s infinite linear;
			}
		</style>
	</head>
	<body  onload="myFunction()" onpageshow="get_rout()"style="margin:0;">
	

<center><div class="flex-container" id="loader">
  <div>
  
  
  <img src="img/151.gif" class="img-responsive" width="100" height="100">
  

</div>

</div></center>

	
   <div style="display:none;" id="myDiv" class="animate-bottom">
		

<nav class="navbar navbar-inverse" >
  <div class="container">
    <div class="navbar-header" style="height:100px">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        
      <i class="fa fa-chrome w3-spin" style="font-size:25px;color:#fff"></i>                      
      </button>
    
      <a class="navbar-brand" href="#"><img src="img/9.gif" onclick="get_rout()" class="img-circle img-responsive" ><font color="#fff">My Maps</font></a>
    
	</div>
	 <div class="collapse navbar-collapse" id="myNavbar">
	<br>
    <div class="navbar-form navbar-right" >
      <div class="form-group">
        <i style="color:#fff;" class="material-icons prefix">gps_not_fixed</i>
       <label style="color:#fff">Source</label> <input type="text" class="form-control" placeholder="Source" name="search" id="source"  data-live-search="true" data-width="75%">
      </div>
      <div class="form-group">
        <i style="color:#fff;" class="material-icons prefix">place</i>
       <label style="color:#fff">Destination</label> <input type="text" class="form-control" placeholder="Destination" name="search" id="destination"  data-live-search="true" data-width="75%">
      </div>
      <button type="button" class="btn btn-info" onclick="get_rout()" data-toggle="collapse" data-target="#myNavbar">
      <span class="glyphicon glyphicon-search"></span> Get Route
    </button>

    </div>
  </div></div>
</nav>

					<p id="mal" class="bg-success" style=""></p>
						<div id="dvDistance" class="bg-success"></div>
				
			
<div class="row">	<div class="col-sm-12">		<div id="maplocation" onload="get_rout()" class="map container img-responsive" style="width: 100%; height: 500px"></div>

</div>
</div>
<footer class="container-fluid text-center">
  <b>© 2018 My Maps.All Rights are Reserved By Hussain</b>
</footer>


	
</div>




<script>
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 2000);
	
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}

</script>
<script type="text/javascript">
        var source, destination;
        var darection = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        google.maps.event.addDomListener(window, 'load', function () {
            new google.maps.places.SearchBox(document.getElementById('source'));
            new google.maps.places.SearchBox(document.getElementById('destination'));
            
        });

        function get_rout() {


            var india = new google.maps.LatLng(21.792657, 78.618164);
            var mapOptions = {
                zoom: 5,
				
			mapTypeId:google.maps.MapTypeId.HYBRID,
                center: india
            };
            map = new google.maps.Map(document.getElementById('maplocation'), mapOptions);
            darection.setMap(map);
            darection.setPanel(document.getElementById('panallocation'));


            source = document.getElementById("source").value;
            destination = document.getElementById("destination").value;

            var request = {
                origin: source,
                destination: destination,
                travelMode: google.maps.TravelMode.DRIVING
            };
            directionsService.route(request, function (response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    darection.setDirections(response);
                }
            });


            
            var service = new google.maps.DistanceMatrixService();
            service.getDistanceMatrix({
                origins: [source],
                destinations: [destination],
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
                avoidHighways: false,
                avoidTolls: false
            }, function (response, status) {
                if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
                    var distance = response.rows[0].elements[0].distance.text;
                    var duration = response.rows[0].elements[0].duration.text;
                    
                    var dvDistance = document.getElementById("dvDistance");
                    dvDistance.innerHTML = "";
                    dvDistance.innerHTML += "<center><b>Distance&nbsp;:&nbsp;&nbsp;" + distance  + "<br /></b></center>";
                    dvDistance.innerHTML += "<center><b>Duration&nbsp;:&nbsp;&nbsp;" + duration +"<br/><b></center>";
					
                    
                    
                } else {
                    alert("Unable to find the distance via road.");
                }
            });
        }
        
        
        
        
    </script>
	
    
</body>
</html>
