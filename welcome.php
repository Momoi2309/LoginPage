<?php 

include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

// Fetch the marker info from the database 
$result = $conn->query("SELECT * FROM points"); 
 
// Fetch the info-window data from the database 
$result2 = $conn->query("SELECT * FROM points"); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Welcome</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->

    <style> 
    #mapCanvas {
    width: 100%;
    height: 650px;
    }

    </style>


  
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATtAlhGNCF5ZutMvgsnCrKNTJU5JkpJG8&callback=initMap"></script>

    <script>
        function initMap(){
            var map;
            var bounds=new google.maps.LatLngBounds();
            var mapOptions={
                mapTypeId:'roadmap'
            };

        //Display a map on the web page
        map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
        map.setTilt(100);

        //Multiple markers location, latitude and longitude
        var markers = [
        <?php if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){ 
                echo '["'.$row['description'].'", '.$row['lat'].', '.$row['longitude'].', "'.$row['icon'].'"],'; 
            } 
        } 
        ?>
    ];

         // Info window content
    var infoWindowContent = [
        <?php if($result2->num_rows > 0){ 
            while($row = $result2->fetch_assoc()){ ?>
                ['<div class="info_content">' +
                '<h3><?php echo $row['description']; ?></h3>' +
                 + '</div>'],
        <?php } 
        } 
        ?>
    ];

     // Add multiple markers to map
     var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
			icon: markers[i][3],
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });

}
// Load initialize function
window.addEventListener('load', initMap);



</script>

</head>


<body>
    <?php echo "<h1>Welcome back " . $_SESSION['username'] .  "</h1>"; ?>
   <h2> <a href="logout.php">Logout</a> </h2>


                <div id="mapContainer">
                    <div id="mapCanvas"></div>
                </div>
     
</body>
</html>