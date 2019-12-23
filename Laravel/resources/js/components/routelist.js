export let routingControl;

export function routeClicked(map, routeList) {
    var allMarkers = [];
    for (let i = 0; i < routeList.length; i++) {
        var lat = routeList[i].location.coordinates[1];
        var lng = routeList[i].location.coordinates[0];
        allMarkers.push([lat, lng]);
    }
    calculateRoute(map, allMarkers);
    allMarkers.length = 0;
}

export function calculateRoute(map, markers) {
    removeRoutingControl(map);
    routingControl = L.Routing.control({
        router: L.Routing.mapbox('pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig'),
        waypoints: markers,
        routeWhileDragging: false,
        show: false,
        createMarker: function () {
            return null;
        }
    }, { show: false });
    routingControl.addTo(map);
    routingControl.show();
}

export function removeRoutingControl(map){
    if (routingControl != null) {
        map.removeControl(routingControl);
        routingControl = null;
    }
}

