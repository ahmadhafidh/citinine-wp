jQuery(document).ready(function ($) {

    var pluginUrl = metaboxScriptParams.pluginUrl;

    /*
     * Icon picker
     */

    var markerExpandButton = $('.expand-marker-selector');

    if (markerExpandButton.length) {

        // Show the selected marker if it has been set
        var currentIconUrl = $('.marker-picker').val();

        if (currentIconUrl.length) {

            // Update the current active icon
            $('.currentIcon').css('background-image', 'url(' + pluginUrl + 'images/pins/' + currentIconUrl + ')');

            // Show the clear button
            $('.clear-marker-selector').show();

        }

        // show the markers
        markerExpandButton.click(function (e) {

            var $markerList = $(e.target).parent().siblings('.iconChooser');

            $markerList.slideToggle();

            e.preventDefault();

        });

        /*
         * Marker chosen click
         */
        $('.iconChooser').on("click", ".mapIcon", function (e) {

            var $clicked = $(this);

            // Mark all icons as unselected
            var $container = $(e.delegateTarget);
            $('a', $container).removeClass('selected');

            // Add selected class
            $clicked.addClass('selected');

            //Update the current active icon
            $('.currentIcon').css('background-image', 'url(' + pluginUrl + 'images/pins/' + $clicked.data('iconfolder') + '/' +  $clicked.data('iconimage') + ')');

            //Fill the hidden field with the url so it can be saved
            $('.marker-picker').val($clicked.data('iconfolder') + '/' +  $clicked.data('iconimage'));

            e.preventDefault();
        });

        //Clear the marker
        $('.clear-marker-selector').click(function (e) {

            //Mark all icons as unselected
            var $container = $(e.delegateTarget);
            $('.mapIcon.selected').removeClass('selected');

            //Update the current active icon
            $('.currentIcon').css('background-image', 'none');

            //Clear the hidden field
            $('.marker-picker').val("");

            e.preventDefault();
        });

    }

    /**
     * Initialize Google map
     */

    if ($('#GoogleMap').length) {

        var marker = null;
        var infowindow = new google.maps.InfoWindow();

        var addMapLocationTitle = $('#title'),
        addMapLocationDescription = $('.addMapLocationDescription'),
        addMapLocationAddress = $('#maplist_address'),
        latLongUpdate = $('#UpdateMap'),
        latField = $('#maplist_latitude'),
        longField = $('#maplist_longitude');

        //Create the map
        //TODO: Get lat/lng from settings
        var latlng = new google.maps.LatLng(maplocationdata.defaultEditMapLocationLat, maplocationdata.defaultEditMapLocationLong);
        var myOptions = {
            zoom: parseInt(maplocationdata.defaultEditMapZoom, 10),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map($("#GoogleMap")[0], myOptions);
        map.setCenter(latlng);

        //Lat long update button
        latLongUpdate.click(function () {
            addMapListMarker(map, new google.maps.LatLng(parseFloat(latField.val()), parseFloat(longField.val())), '');
            latField.val();
            longField.val();
            return false;
        });

        //Map search
        var input = $('#MapSearchInput')[0];
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        //Make return key search
        $("#MapSearchInput").keypress(function (event) {
            if (event.which == 13) {    // make enter key just search map and stop it from submitting form
                event.preventDefault();
            }
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            // infowindow.close();
            var place = autocomplete.getPlace();
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
            }

            // Instructions: update the array below to change the order and
            // items the address is autofilled with
            // Full list of options ["place_name","street_number","route","locality","administrative_area_level_2","postal_code","country","postal_town"]
            var addressPartsToUse = ["place_name", "street_number", "route", "locality", "postal_code", "country"];

            var street_numberIndex = -1;
            var routeIndex = -1;

            var address = [];

            //Loop over the address parts
            for (var j = 0; j < place.address_components.length; j++) {

                //Get the part type
                var att = place.address_components[j].types[0];

                //See if it's a part we want
                var partIndex = $.inArray(att, addressPartsToUse);

                //Fill an array in the correct order
                if (partIndex != -1) {

                    //Needed to concatenate the first line
                    if (att == "street_number") {street_numberIndex = partIndex;}
                    if (att == "route") {routeIndex = partIndex;}

                    //Mark as done to stop duplicates
                    addressPartsToUse[partIndex] = "done";

                    //If empty go to next one
                    if (place.address_components[j].long_name !== '') {
                        //Add it to the array
                        address[partIndex] = place.address_components[j].long_name;
                    }

                }
            }

            //If street_number and route exist combine them
            if (street_numberIndex !== -1 && routeIndex !== -1) {
                address[street_numberIndex] = address[street_numberIndex] + " " + address[routeIndex];
                address.splice(routeIndex, 1);
            }

            //See if place name is needed and
            //If place name is not first line of address add it to the address
            var nameIndex = $.inArray("place_name", addressPartsToUse);
            if (nameIndex !== -1 && address[street_numberIndex] != place.name) {
                address[nameIndex] = place.name;
            }

            //Remove any empty items from array
            var newAddressArray = [];
            for (var i = 0; i < address.length; i++) {
                if (address[i] !== undefined && address[i] !== null && address[i] !== "") {
                    newAddressArray.push(address[i]);
                }
            }

            var htmlAddress = newAddressArray.join('<br />');
            var textAddress = newAddressArray.join('\n');

            addMapListMarker(map, place.geometry.location, htmlAddress);

            //If title is empty fill it
            if (addMapLocationTitle.val() === "") {
                $('#title-prompt-text').addClass('screen-reader-text');
                addMapLocationTitle.val(place.name);
            }

            //Fill the description box
            if (typeof (tinymce) != "undefined") {
                if (tinymce.activeEditor != null && tinymce.activeEditor.isHidden() != true) {
                    //Check that editor is empty
                    if (tinymce.activeEditor.getContent() == "" || tinymce.activeEditor.getContent() == null) {
                        tinymce.activeEditor.setContent(htmlAddress);
                    }
                } else {
                    //Check to make sure it is empty
                    if ($('#maplist_description').val() == "") {
                        $('#maplist_description').val(htmlAddress);
                    }
                }
            }

            updateMapFields(place.geometry.location, textAddress);

            return false;

        });

        if (latField.val() != '' && longField.val() != '') {
            addMapListMarker(map, new google.maps.LatLng(latField.val(), longField.val()), '');
        }

        //Map clicked
        google.maps.event.addListener(map, 'click', function (event) {

            //Content for infowindow
            var html = '';

            //Try to get address from lat/lng
            reverseGeo(map, event.latLng);
        });
    }

    function reverseGeo(map, point) {
        //Try to get address from lat/lng
        var html = 'Chosen location';
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'latLng': point}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK && results[0]) {
                html = results[0].formatted_address;
                addMapListMarker(map, point, html);

            } else {
                addMapListMarker(map, point, 'Clicked location');
            }

            updateMapFields(point, html);
        });
    }

    function updateMapFields(point, addressText) {
        var addMapLocationAddress = $('#maplist_address'),
        latLongUpdate = $('#UpdateMap'),
        latField = $('#maplist_latitude'),
        longField = $('#maplist_longitude');

        //Only update address if exists and it's not already been completed
        if (addMapLocationAddress.length && !addMapLocationAddress.val().length) {
            addMapLocationAddress.val(addressText);
        }

        if (latField.length && longField.length) {
            latField.val(point.lat());
            longField.val(point.lng());
        }
    }

    function addMapListMarker(map, point, html) {
        map.panTo(point);
        map.setZoom(16);

        if (marker == null) {
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: point
            });
        } else {
            marker.setPosition(point);
        }

        infowindow.setContent(html);
        infowindow.open(map, marker);

        //Dragged marker stop
        google.maps.event.addListener(marker, 'dragend', function () {
            $('#maplist_latitude').val(marker.getPosition().lat());
            $('#maplist_longitude').val(marker.getPosition().lng());

            reverseGeo(map, marker.getPosition());
        });
    }
});
