<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leaflet</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
</head>


{!! HTML::script('js/leaflet.js')!!}
{!! HTML::script('js/GeoJSONExample/Example1.js')!!}
{!! HTML::script('js/leaflet/leaflet-routing-machine.js')!!}

{!! HTML::style('css/leaflet/leaflet.css') !!}
{!! HTML::style('css/leaflet/leaflet-map.css') !!}
{!! HTML::style('css/leaflet/leaflet-routing-machine.css') !!}

    <body>
        <div id="mapid"> </div>

        <script> 
            var mymap = L.map('mapid').setView([52.143438, 6.215206], 7.5);

            <script src="leaflet/leaflet.js"></script>
	
            L.tileLayer('https://api.mapbox.com/styles/v1/sakirma/cjsj37dym6e401gqi2zcu2aph/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'sakirma.cjsj37dym6e401gqi2zcu2aph',
                accessToken: 'pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig' // AccessToken has only read permission.
                var myInterface = L.travelNotes.interface ( );
			myInterface.addControl ( mymap, null, { position: "topright"} );
			myInterface.rightContextMenu = true;
            }).addTo(mymap);
            
            L.Routing.control({
                waypoints: [
                    L.latLng(51.738713, 5.392532),
                    L.latLng(51.738288, 5.428931)
                ]
                }).addTo(map);
            
            // TODO: This has to be done through the database. Retrieve the GeoJSON data and convert it using json_encode().
            L.geoJSON(example).addTo(mymap);

            console.log("wat");
        </script>
    </body>
</html>