jQuery(document).ready(function ($) {

    function FullPageMap() {

        //Convert json to object
        var location = ko.utils.parseJson(maplistFrontScriptParams.location);

        //Self reference
        var self = this;

        //Map options
        self.mapOptions = {
           zoom: 15,
           center: new google.maps.LatLng(location.latitude, location.longitude),
           mapTypeId: google.maps.MapTypeId.ROADMAP,
           panControl: false,
           zoomControl: true,
           mapTypeControl: true,
           scaleControl: true,
           streetViewControl: true,
           overviewMapControl: false
       };

        //Stylers
        self.customstylers = maplistFrontScriptParams.customstylers;

        if (self.customstylers !== '') {
            self.mapOptions.styles = $.parseJSON(self.customstylers);
        }

        self.mapCanvas = $('#SingleMapLocation');

        //Get height and width for infowindows
        self.infoWindowWidth = self.mapCanvas.width() * 0.7;
        self.infoWindowHeight = self.mapCanvas.height() * 0.7;

        self.map = new google.maps.Map(self.mapCanvas[0], self.mapOptions);

        //Only if on the page
        if ($('.getdirections').length) {

            //Directions
            self.awaitingGeoDirections = null;
            self.awaitingGeoDirectionsLocation = null;
            self.directionsType = google.maps.TravelMode.DRIVING;
            self.directionsService = new google.maps.DirectionsService();
            self.directionsRenderer = new google.maps.DirectionsRenderer({draggable: true});
            self.measurementUnits = maplistFrontScriptParams.measurementUnits;

            $('.getdirections').click(function (e) {

                var thisButton = $(e.currentTarget);
                var endLocation = location.latitude + ',' +  location.longitude;

                //The start/end locations
                var locationEntryField = thisButton.siblings('.directionsPostcode');
                var startLocation = locationEntryField.val();

                //If no location entered show error
                if (startLocation === '') {
                    locationEntryField.addClass('error');
                }                else {
                    locationEntryField.removeClass('error');
                    //Show directions with our data
                    self.showDirections(startLocation, endLocation, thisButton);
                }

                e.preventDefault();
            });
        }

        /*
         * Show the directions in thee list item
         */
        self.showDirections = function (from, to, buttonClicked) {

            //Hide any errors
            $('.mapLocationDirectionsError').hide();

            //Link Renderer to the map
            self.directionsRenderer.setMap(self.map);

            //The directions list div
            var directionsHolder = buttonClicked.siblings('.mapLocationDirectionsHolder');

            //Measurement units to use
            var unitSystem;
            if (self.measurementUnits == "METRIC") {
                unitSystem = google.maps.UnitSystem.METRIC;
            } else {
                unitSystem = google.maps.UnitSystem.IMPERIAL;
            }

            //Request object
            var request = {
                origin: from,
                destination: to,
                travelMode: self.directionsType,
                unitSystem: unitSystem
            };

            self.directionsRenderer.setPanel(directionsHolder[0]);

            self.directionsService.route(request, function (response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    self.directionsRenderer.setDirections(response);
                    //Don't add the print button twice
                    if (!$(directionsHolder[0]).next().hasClass('printDirections')) {
                        $(directionsHolder[0]).after('<a href="#" class="printDirections corePrettyStyle">' + maplistFrontScriptParams.printDirectionsMessage + '</a>');
                    }

                    //hide the infowindow
                    self.infowindow.close();
                } else {

                    console.log(status);
                    $('.mapLocationDirectionsError').show();
                }
            });
        };

        //Marker
        self.position = new google.maps.LatLng(location.latitude, location.longitude);

        var markerOptions = {
            map: self.map,
            position: self.position,
            title: location.title,
            icon: image,
            content: '',
            animation: google.maps.Animation.DROP
        };

        //Add the custom icon if specified
        if (location.pinImageUrl !== null) {
            var image = new google.maps.MarkerImage(
              location.pinImageUrl
            );

            markerOptions.icon = image;
        }

        self.marker = new google.maps.Marker(markerOptions);

        if (maplistFrontScriptParams.disableInfoBoxes == 'true') {
            //Infowindow
            self.infowindow = new google.maps.InfoWindow({pixelOffset: new google.maps.Size(0, 0)});
        } else {

            //Infobox switched on
            self.infoBoxOptions = {
              alignBottom: true,
              content: "",
              disableAutoPan: false,
              closeBoxMargin: "10px 2px 2px 2px",
              closeBoxURL: "https://www.google.com/intl/en_us/mapfiles/close.gif",
              enableEventPropagation: false,
              infoBoxClearance: new google.maps.Size(40, 40),
              isHidden: false,
              pane: "floatPane",
              zIndex: 1500
          };

            if (maplistFrontScriptParams.infoboxstyle === "bubble") {
                //InfoBubble
                self.infoBoxOptions.backgroundClassName = "infoWindowContainer infobubble";
                self.infoBoxOptions.minHeight = self.infoWindowWidth;
                self.infoBoxOptions.maxHeight = self.infoWindowWidth;
                self.infoBoxOptions.minWidth = self.infoWindowHeight;
                self.infoBoxOptions.maxWidth = self.infoWindowHeight;
                self.infoBoxOptions.padding = 0;

                self.infowindow = new InfoBubble(self.infoBoxOptions);
            }            else {
                //Infobox
                self.infoBoxOptions.boxClass = "infoWindowContainer infobox";
                self.infoBoxOptions.pixelOffset = new google.maps.Size((self.infoWindowWidth / 2) * -1, -40);
                self.infoBoxOptions.boxStyle = {
                  width:  self.infoWindowWidth + "px"
              };

                self.infowindow = new InfoBox(self.infoBoxOptions);
            }

        }

        //TODO:Create builder for this and move it server side
        self.content = "<div class='infoWindow'>";
        self.content += "<h3>" + location.title + "</h3>";
        self.content += '<div class="infowindowContent">';
        if (location.imageUrl) {
            self.content += "<img src='" + location.imageUrl + "' class='locationImage'/>";
        }
        self.content += "<p>" + location.description + "</p>";
        self.content += "</div>";
        self.content += "</div>";

        self.infowindow.setContent(self.content);
        // self.infowindow.open(self.map, self.marker);

        //Click the marker
        //-----------------------------
        google.maps.event.addListener(self.marker, 'click', function () {
             //Show the bubble
             self.infowindow.open(self.map, self.marker);
         });
    }

    //Print directions
    function printDirectionsContent(content) {
        newwin = window.open('', 'printwin', '');
        newwin.document.write('<HTML>\n<HEAD>\n');
        newwin.document.write('<TITLE>Print Page</TITLE>\n');
        newwin.document.write('<script>\n');
        newwin.document.write('function chkstate(){\n');
        newwin.document.write('if(document.readyState=="complete"){\n');
        newwin.document.write('setTimeout("window.close()", 10); \n');
        newwin.document.write('}\n');
        newwin.document.write('else{\n');
        newwin.document.write('setTimeout("chkstate()",2000)\n');
        newwin.document.write('}\n');
        newwin.document.write('}\n');
        newwin.document.write('function print_win(){\n');
        newwin.document.write('window.print();\n');
        newwin.document.write('chkstate();\n');
        newwin.document.write('}\n');
        newwin.document.write('<\/script>\n');
        newwin.document.write('</HEAD>\n');
        newwin.document.write('<BODY onload="print_win()">\n');
        newwin.document.write(content);
        newwin.document.write('</BODY>\n');
        newwin.document.write('</HTML>\n');
        newwin.document.close();
    }

    //Print button for directions
    $('body').on('click', '.printDirections', function () {
        var content = $(this).prev().html();
        printDirectionsContent(content);
        return false;
    });

    var fullPageMap = new FullPageMap();
});
