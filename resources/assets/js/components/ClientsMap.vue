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
                    pins: [],
                    layerData: [],
                    layerMarkers: [],
                }
        },
        mounted() {
        	$("#leaflet-map").height(this.data.mapHeight);
        	var lf = this;
        	if ($('#leaflet-map').length) {
        		lf.initMap();
            	lf.initMarkers();
			}
        },
        methods: {
            log(message){
                console.log(message);
            },
            initMap() {
                this.tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 17,
                    attribution: 'Tiles courtesy of <a href="http://openstreetmap.org/" target="_blank">OpenStreetMap</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                });

                var baseMaps = {
                    "OpenStreetMap": this.tileLayer
                };

                var overlays = {};

                var options = {
                    "collapsed": false,
                    "hideSingleBase": true
                };

                this.clients_map = L.map('leaflet-map', {
                    layers: [this.tileLayer],
                    sleep: true,
                    hoverToWake: false,
                    sleepNote: true,
                    wakeMessage: 'Kliknij',
                    sleepButton: function(){
                        return new L.Control.SleepMapControl({ prompt: "Kliknij" });
                    },
                    sleepOpacity: .7
                }).setView([51.919438, 19.145136], this.data.mapZoom);

                if(this.data.mapMode == 'large'){
                    this.layerControl = L.control.layers(baseMaps, overlays, options).addTo(this.clients_map);
                }

                //this.tileLayer.addTo(this.clients_map);
            },
            initMarkers() {
                if(this.data.mapMode == 'small'){
                    this.data.markers.forEach((marker) => {
                        this.pins.push(marker);
                    })

                    this.pins.forEach((pin) => {
                        pin.leafletObject = L.marker(pin.coords);
                        pin.leafletObject.addTo(this.clients_map);
                        if(this.data.mapMode == 'small'){
                            this.centerLeafletMapOnMarker(this.clients_map, pin.leafletObject)
                        } 
                    }) 
                } else {

                    this.data.layers.forEach((layer) => {
                        this.layerData.push(layer);
                    })
                    
                    this.layerData.forEach((layerD) => {
                        const layer_data = new Object();

                        let myCustomColour = layerD.color;

                        const markerHtmlStyles = 'background-color: '+myCustomColour+';width: 2rem;height: 2rem;display: block;left: -1rem;top: -1rem;position: relative;border-radius: 2rem 2rem 0;transform: rotate(45deg);border: 1px solid #FFFFFF'

                        let icon = L.divIcon({className: 'custom-icon', html: '<span style="'+markerHtmlStyles+'" />'})
                        layer_data.markers = [];
                        layerD.markers.forEach((marker) => {
                            var markerOptions = {
                                title: marker.title,
                                icon: icon
                            }
                            marker.leafletObject = L.marker(marker.coords, markerOptions).bindPopup(marker.content);                      
                            layer_data.markers.push(marker.leafletObject);
                        });

                        layer_data.name = layerD.name;
                        
                        this.layerMarkers.push(layer_data);
                    })

                    var first = true;
                    
                    this.layerMarkers.forEach((lm) => {
                        var layerGroup = L.layerGroup(lm.markers);
                        if(first){
                            layerGroup.addTo(this.clients_map);
                            this.clients_map.addControl( new L.Control.Search({layer: layerGroup, propertyName: 'title', hideMarkerOnCollapse: true}) );
                            first = false;
                            
                        }                    
                        this.layerControl.addOverlay(layerGroup, lm.name);
                    })
                }      
            },
            centerLeafletMapOnMarker(map, marker){
                var latLngs = [ marker.getLatLng() ];
                var markerBounds = L.latLngBounds(latLngs);
                map.fitBounds(markerBounds);
            },
        },        
	}
</script>