const latlong = [-6.2607122, 106.6832656]
const difossIcon = L.icon({
    iconUrl: `${baseUrl}assets/images/logo.png`,

    iconSize:     [38, 38], // size of the icon
    iconAnchor:   [20, 40], // point of the icon which will correspond to marker's location
    popupAnchor:  [-2, -40] // point from which the popup should open relative to the iconAnchor
});
var map = L.map('map').setView(latlong, 16);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var marker = L.marker(latlong, {icon: difossIcon}).addTo(map);
marker.bindPopup("<b>DIFOSS</b><br>DIFOSS is FOSS (Friendly Open Source Software)").openPopup();