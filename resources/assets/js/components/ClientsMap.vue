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
                    pins: null,
                }
        },
        mounted() {
        	$("#leaflet-map").height(900);
        	var lf = this;
        	if ($('#leaflet-map').length) {
        		lf.initMap();
            	lf.initMarkers();
                lf.getAllClients();
			}
        },
        methods: {
            log(message){
                console.log(message);
            },
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
                    this.pins.push(marker);
                })
                this.pins.forEach((pin) => {
                    pin.leafletObject = L.marker(pin.coords).bindPopup(pin.name);
                    pin.leafletObject.addTo(this.clients_map);
                })                
            },
            getAllClients() {
                $.ajax({
                  type:'get',
                  async:false,
                  dataType: "JSON",
                  //data: {alarm_id: this.data.vehicles},
                  url:'admin/client/getclientslocations',
                  success: function(result){
                      //$('h3.counter').text(result.players);
                      this.log('testowo:'+result);
                  }
                });
            },
        },        
	}
</script>