<template>
	<div id="clients-map">
		<div class="leaflet-map-container">
	        <div id="leaflet-map" class="map"></div>
	    </div>
	</div>
</template>

<script>
	export default {
        props: {
            data: {
                type: Object
            }
        },
        data() {
                return {
                    map: null,
                    currentTab : 0,
                    name: 'leaflet',
                    tileLayer: null,
                    vehicleCount: this.data['Vnum'],
                    driverCount: this.data['Dnum'],
                    loggedUser: this.data['user'],
                    markers: [
                    {
                        id: 0,
                        name: 'Cars',
                        position: 'top',
                        icon: 'fas fa-car',
                        vehicles: this.data['vehicles'],
                        locations: this.data['locations']
                    },
                    {
                        id: 1,
                        name: 'Drivers',
                        position: 'top',
                        icon: 'fas fa-users',
                        drivers: this.data['drivers']
                    },
                    {
                        id: 2,
                        name: 'Settings',
                        position: 'bottom',
                        icon: 'fas fa-cog',
                        settings: this.data['settings']
                    }],
                }
        },
        mounted() {
        	$("#leaflet-map").height(900);
        	var lf = this;
        	if ($('#leaflet-map').length) {
        		lf.initMap();
            	//lf.initMarkers();
			}
        },
        methods: {
            initMap() {
                this.clients_map = L.map('leaflet-map', {
                    sleep: true,
                    hoverToWake: false,
                    sleepNote: true,
                    wakeMessage: 'Kliknij',
                    sleepButton: L.Control.sleepMapControl,
                    sleepOpacity: .7
                }).setView([51.919438, 19.145136], 7);
                this.tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 17,
                    attribution: 'Tiles courtesy of <a href="http://openstreetmap.org/" target="_blank">OpenStreetMap</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                });

                this.tileLayer.addTo(this.clients_map);
            },
            initMarkers() {

                this.markers.forEach((marker) => {
                	if(layer.features){
	                    const markerFeatures = layer.features.filter(feature => feature.type === 'marker');
	                    markerFeatures.forEach((feature) => {
	                        feature.leafletObject = L.marker(feature.coords).bindPopup(feature.name);
	                    });
	                }
                })
                
            },
            getClients() {
                $.ajax({
                  type:'get',
                  async:false,
                  dataType: "JSON",
                  //data: {alarm_id: this.data.vehicles},
                  url:'admin/client/getclientslocations',
                  success: function(result){
                      //$('h3.counter').text(result.players);
                      this.log('testowo:', result);
                  }
                });
            },
        },        
	}
</script>