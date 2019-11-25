function initialize() {
    $("form").on("keyup keypress", function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
    const locationInputs = document.getElementsByClassName("map-input");

    const autocompletes = [];
    const geocoder = new google.maps.Geocoder();
    for (let i = 0; i < locationInputs.length; i++) {
        const input = locationInputs[i];
        const fieldKey = input.id.replace("-input", "");
        // const isEdit =
        //     document.getElementById(fieldKey + "-latitude").value != "" &&
        //     document.getElementById(fieldKey + "-longitude").value != "";

        const isEdit =
            document.getElementById("latitude").value != "" &&
            document.getElementById("longitude").value != "";

        // const latitude =
        //     parseFloat(document.getElementById(fieldKey + "-latitude").value) ||
        //     25.6741;
        // const longitude =
        //     parseFloat(
        //         document.getElementById(fieldKey + "-longitude").value
        //     ) || 55.9804;

        const latitude =
            parseFloat(document.getElementById("latitude").value) || 25.8006251;
        const longitude =
            parseFloat(document.getElementById("longitude").value) ||
            55.9734596;

        const map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: latitude, lng: longitude },
            zoom: 15
        });

        const marker = new google.maps.Marker({
            map: map,
            position: { lat: latitude, lng: longitude }
        });

        marker.setVisible(isEdit);

        const autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.key = fieldKey;
        autocompletes.push({
            input: input,
            map: map,
            marker: marker,
            autocomplete: autocomplete
        });
    }

    for (let i = 0; i < autocompletes.length; i++) {
        const input = autocompletes[i].input;
        const autocomplete = autocompletes[i].autocomplete;
        const map = autocompletes[i].map;
        const marker = autocompletes[i].marker;

        google.maps.event.addListener(
            autocomplete,
            "place_changed",
            function() {
                marker.setVisible(false);
                const place = autocomplete.getPlace();

                geocoder.geocode({ placeId: place.place_id }, function(
                    results,
                    status
                ) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        const street =
                            results[0].address_components[0].short_name +
                            ", " +
                            results[0].address_components[1].short_name;
                        const full_address = results[0].formatted_address;
                        const lat = results[0].geometry.location.lat();
                        const lng = results[0].geometry.location.lng();
                        setLocationCoordinates(
                            autocomplete.key,
                            lat,
                            lng,
                            street,
                            full_address
                        );
                    }
                });

                if (!place.geometry) {
                    window.alert(
                        "No details available for input: '" + place.name + "'"
                    );
                    input.value = "";
                    return;
                }

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                    map.setZoom(15);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(15);
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
            }
        );
    }
}

function setLocationCoordinates(key, lat, lng, street, full_address) {
    // const latitudeField = document.getElementById(key + "-" + "latitude");
    // const longitudeField = document.getElementById(key + "-" + "longitude");
    // latitudeField.value = lat;
    // longitudeField.value = lng;
    $("#latitude").val(lat);
    $("#longitude").val(lng);
    $("#street").val(street);
    $("#full_address").val(full_address);
}
