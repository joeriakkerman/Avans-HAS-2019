let map;
//let projectMarkers = L.featureGroup().addTo(map);

let projectMarkers;
let routingControl;


export default {

    getProjectMarkers: function () {
        return projectMarkers;
    },
    setVariables: function (m) {

        map = m;
        map.doubleClickZoom.disable();

        routingControl = L.Routing.control({
            router: L.Routing.mapbox('pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig', {profile: "mapbox/cycling"}),
            waypoints: [null],
            routeWhileDragging: false,
            addWaypoints: false,
            createMarker: function () {
                return null;
            }
        }).on('routesfound', this.updateMarkersToRoute).addTo(map);

        projectMarkers = L.featureGroup().addTo(map);
        projectMarkers.on('dblclick', this.mouseRemoveMarker);

        return routingControl;
    },
    uploadRoute: function (name) {

        let layers = projectMarkers.getLayers();

        if (layers.length < 1) return window.alert("Creëer eerst een route!");

        let distance = layers[0].options.distance;
        let route = {name: name, latlngs: [], ids: [], distance: distance};


        for (let i = 0; i < layers.length; i++) {
            route.latlngs.push(layers[i].getLatLng());
            route.ids.push(layers[i].options.id);
        }

        axios.post('/admin/route/create', route).then(response => {
           console.log(response);
        }).catch(error => {
            console.log(error);
        });

        window.alert("Route aangemaakt!");
        //location.reload();
    },
    placeMarker: function (point) {

        //let projectInfo = await this.getProjectInfo(id);
        let latlng = new L.latLng(point.location.coordinates[1], point.location.coordinates[0]);

        L.marker(latlng, {
            draggable: false,
            riseOnHover: true,
            id: point.id,
            name: point.name,
            info: point.information,
        }).bindPopup(
            '<p>' + latlng + '</p>' +
            '<p> Naam: ' + point.name + '</p>' +
            '<p> Informatie: ' + point.information + '</p>'
        )
            .addTo(projectMarkers);
        // .on('dragend', calculateRoute)

        return projectMarkers.getLayers();
    },

    getProjectInfo: function (id) {

        let token = document.getElementsByName('csrf-token')[0].getAttribute('content');

        return fetch('/admin/route/projects', {
            method: 'post',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
                'X-CSRF-Token': token,
            },
            body: 'id=' + id,
        })
            .then(function (res) {
                return res.json();
            })
            .catch(function (err) {
                console.log(err)
            });
    },

    clearMarkers: function () {
        projectMarkers.clearLayers();
        routingControl.setWaypoints([]);
    },

    removeMarker: function (point) {

        let latlng = L.latLng(point.location.coordinates[1], point.location.coordinates[0]);

        let routes = routingControl.getWaypoints();
        let layers = projectMarkers.getLayers();
        let newRoutes = [];

        //Update leaflet layer
        for (let i = 0; i < layers.length; i++) {
            if (layers[i].options.id === point.id) {
                projectMarkers.removeLayer(layers[i]);
            }
        }
        //Update routing machine
        for (let i = 0; i < routes.length; i++) {
            if ((routes[i].latLng !== null) && (!routes[i].latLng.equals(latlng))) {
                newRoutes.push(L.routing.waypoint(L.latLng(routes[i].latLng.lat, routes[i].latLng.lng), routes[i].name, {
                    name: routes[i].name,
                    info: routes[i].options.info
                }));
            }
        }
        routingControl.setWaypoints(newRoutes);
    },

    mouseRemoveMarker: function (e) {

        projectMarkers.removeLayer(e.layer);
        let routes = routingControl.getWaypoints();
        let newRoutes = [];

        for (let i = 0; i < routes.length; i++) {

            if ((routes[i].latLng !== e.latlng) && (routes[i].latLng !== null)) {
                newRoutes.push(L.routing.waypoint(L.latLng(routes[i].latLng.lat, routes[i].latLng.lng), routes[i].name, {
                    id: routes[i].options.id,
                    name: routes[i].options.name,
                    info: routes[i].options.info,
                }));
            }
        }
        routingControl.setWaypoints(newRoutes);
    },


    updateMarkersToRoute: function (e) {
        projectMarkers.clearLayers();

        for (let i = 0; i < e.waypoints.length; i++) {

            //let elem = document.getElementById("travel-info");
            let mId = e.waypoints[i].name;

            let projectInfo = e.waypoints[i].options.info;
            let pointName = e.waypoints[i].options.name;

            if (mId === undefined) {
                mId = Math.random().toString(36).substring(7);
            }

            L.marker(e.waypoints[i].latLng, {
                draggable: false,
                riseOnHover: true,
                id: mId,
                name: pointName,
                info: projectInfo,
                distance: e.routes[0].summary.totalDistance,
                travelTime: e.routes[0].summary.totalTime
            })
                .bindPopup(
                    '<p>' + e.waypoints[i].latLng.lat + ' , ' + e.waypoints[i].latLng.lng + '</p>' +
                    '<p> Naam: ' + pointName + '</p>' +
                    '<p> Informatie: ' + projectInfo + '</p>'
                ).addTo(projectMarkers);

        }
    },


    createWaypoints: function () {

        let markers = projectMarkers.getLayers();
        let waypoints = [];

        for (let i = 0; i < markers.length; i++) {
            waypoints.push(L.routing.waypoint(L.latLng(markers[i].getLatLng().lat, markers[i].getLatLng().lng), markers[i].options.id, {
                id: markers[i].options.id,
                name: markers[i].options.name,
                info: markers[i].options.info
            }));
        }
        return waypoints;
    },

    showRoute: function (id) {

        projectMarkers.clearLayers();
        let token = document.getElementsByName('csrf-token')[0].getAttribute('content');

        return fetch('/admin/route/points', {
            method: 'post',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
                'X-CSRF-Token': token,
            },
            body: 'routeId=' + id,

        })
            .then(function (res) {
                return res.json();
            })
            .then(function (data) {
                return JSON.parse(JSON.stringify(data));
            })
            .catch(function (error) {
                console.log('Request failed', error);
            });
    },

    removeRouteFromDatabase: function (route) {

        if (route) {
            let xhttp = new XMLHttpRequest();
            let token = document.getElementsByName('csrf-token')[0].getAttribute('content');

            xhttp.open('POST', '/admin/route/remove');
            xhttp.onreadystatechange = function () {
                if (!(xhttp.readyState === 4 && xhttp.status === 200)) {
                    return;
                }

                console.log(xhttp.response);
                window.alert("Route succesvol verwijderd!");
                //location.reload();
            };

            xhttp.setRequestHeader('X-CSRF-Token', token);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.send("routeID=" + route);

        } else {
            alert("You need to specify the route you want to delete");
        }
    },


}



