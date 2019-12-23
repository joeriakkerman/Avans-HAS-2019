/*
let leaflet_core = (function() {

    let map = L.map('leaflet').setView([52.143438, 6.215206], 7.5);
    let control;

    return {

    init: function(){
            L.tileLayer('https://api.mapbox.com/styles/v1/sakirma/cjsj37dym6e401gqi2zcu2aph/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'sakirma.cjsj37dym6e401gqi2zcu2aph',
                accessToken: 'pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig' // AccessToken has only read permission.
            }).addTo(map);

            //map.locate({setView: true, maxZoom: 16});
            console.log('Leaflet is initialized!');
        },

        calculateDistance: function(latlng1, latlng2){
            let lat1 = latlng1.lat;
            let lon1 = latlng1.lng;

            let lat2 = latlng2.lat;
            let lon2 = latlng2.lng;

            let R = 6371; // km (change this constant to get miles)
            let dLat = (lat2-lat1) * Math.PI / 180;
            let dLon = (lon2-lon1) * Math.PI / 180;
            let a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(lat1 * Math.PI / 180 ) * Math.cos(lat2 * Math.PI / 180 ) *
                Math.sin(dLon/2) * Math.sin(dLon/2);
            let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
            let d = R * c;

            return Math.round(d*1000)
        },

        getMap: function() {
            return map;
        }
    }
})();
*/