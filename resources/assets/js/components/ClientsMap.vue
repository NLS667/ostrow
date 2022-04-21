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
        mounted() {
        	$("#leaflet-map").height(900);
        	var lf = this;
        	if ($('#leaflet-map').length) {
        		lf.initMap();
            	//lf.initLayers();
			}
        },
        methods: {
            initMap() {
                this.clients_map = L.map('leaflet-map', {
                    sleep: true,
                    hoverToWake: true,
                    sleepNote: false,
                    sleepOpacity: 1
                }).setView([51.919438, 19.145136], 9);
                this.tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 17,
                    attribution: 'Tiles courtesy of <a href="http://openstreetmap.org/" target="_blank">OpenStreetMap</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                });

                this.tileLayer.addTo(this.clients_map);
            },
            initLayers() {

                this.layers.forEach((layer) => {
                	if(layer.features){
	                    const markerFeatures = layer.features.filter(feature => feature.type === 'marker');
	                    markerFeatures.forEach((feature) => {
	                        feature.leafletObject = L.marker(feature.coords).bindPopup(feature.name);
	                    });
	                }
                })
                
            },
            layerChanged(layerId, active) {
                const layer = this.layers.find(layer => layer.id === layerId);
                layer.features.forEach((feature) => {
                    if (active) {
                        feature.leafletObject.addTo(this.clients_map);
                    } else {
                        feature.leafletObject.removeFrom(this.clients_map);
                    }
                });
            },
        },        
	}
</script>