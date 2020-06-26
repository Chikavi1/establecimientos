

 document.addEventListener('DOMContentLoaded', () => {

 	if(document.querySelector('#mapa')){


    const lat = document.querySelector("#lat").value === '' ? 20.620603 : document.querySelector("#lat").value;
    const lng = document.querySelector("#lng").value === '' ? -103.305492 : document.querySelector("#lng").value;

    const mapa = L.map('mapa').setView([lat, lng], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapa);
 
    const geocodeService = L.esri.Geocoding.geocodeService();

    const buscador = document.querySelector('#formbuscador');
    buscador.addEventListener('input',buscarDireccion);

    let marker;

    // agregar el pin
    marker = new L.marker([lat, lng],{
    	draggable: true,
    	autoPan: true
    }).addTo(mapa);


    //detectar movimiento del marker
    marker.on('moveend', function(e){

    	marker = e.target;

    	const posicion = marker.getLatLng();

    	//center automaticamente

    	mapa.panTo(new L.LatLng(posicion.lat,posicion.lng));

    	// Reverse Geocoding, cuando el usuario reubica el pin
    	geocodeService.reverse().latlng(posicion,16).run(function(error,resultado){

    		marker.bindPopup(resultado.address.LongLabel);
    		marker.openPopup();

    		//Llenar los campos
    		llenarInputs(resultado);
    	})
    });
  		
    	function buscarDireccion(e){

    		if(e.target.value.lenght > 10){

    		}
    	}

    	function llenarInputs(resultado){
    		document.querySelector('#direccion').value = resultado.address.Address;
    		document.querySelector('#colonia').value = resultado.address.Neighborhood;
    		document.querySelector('#lat').value = resultado.latlng.lat;
    		document.querySelector('#lng').value = resultado.latlng.lng;
    	}

 		}
});