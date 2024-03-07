'use strict';

document.addEventListener('DOMContentLoaded', () => {

    // ------------------ Hamburger menu---------------//
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.navbar-nav');

    if (hamburger && navMenu) { // Check if elements exist
        hamburger.addEventListener('click', function () {
            navMenu.classList.toggle('show');
        });
    }

    //------------------ Driver signup form validation---------------//
    document.getElementById('personalDetailsForm').addEventListener('submit', function(event) {
        let isValid = true; // Flag to keep track of whether the form is valid

        // Validate Name
        let name = document.getElementById('name').value;
        if (!name) {
            alert('Name must be filled out');
            isValid = false;
        }

        // Validate Email
        let email = document.getElementById('email').value;
        if (!email || !validateEmail(email)) { // Using a helper function to validate email
            alert('Please enter a valid email');
            isValid = false;
        }

        // Validate Password
        let password = document.getElementById('password').value;
        if (!password || password.length < 8) { // Example: check if password is at least 8 characters
            alert('Password must be at least 8 characters long');
            isValid = false;
        }

        // Validate File Upload (Profile Photo)
        let profilePhoto = document.getElementById('profile_photo').files;
        if (!profilePhoto.length) {
            alert('Profile photo is required');
            isValid = false;
        }

        // If the form is not valid, prevent its submission
        if (!isValid) {
            event.preventDefault(); // Prevent form submission
        }
    });

    // Helper function to validate email format
    function validateEmail(email) {
        const regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return regex.test(String(email).toLowerCase());
    }
    





    // HERE Maps API initialization
    var platform = new H.service.Platform({
        'apikey': 'bc1jXDa0GtxqIOL1LvdT7FAWzUdaoZ24NYOQuTR3NtY'
    });

    const defaultLayers = platform.createDefaultLayers();
    const map = new H.Map(document.getElementById("mapContainer"), defaultLayers.vector.normal.map, {
        zoom: 9,
        center: { lat: 49.650638, lng: -125.449391 }, // Center map on Vancouver Island
        padding: { top: 50, right: 50, bottom: 50, left: 50 }
    });

    const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
    window.addEventListener('resize', () => map.getViewPort().resize());

    // Listen to input events on both departure and arrival input fields
    document.getElementById('departure').addEventListener('input', calculateAndDisplayRoute);
    document.getElementById('arrival').addEventListener('input', calculateAndDisplayRoute);

    function calculateAndDisplayRoute() {
        const geocoder = platform.getSearchService();

            let departureAddress = document.getElementById('departure').value + ', Canada'+',BC'+',Comox Valley'; // Append ', Canada' to limit to Canada
            let arrivalAddress = document.getElementById('arrival').value + ', Canada'+',BC'+',Comox Valley'; // Append ', Canada' to limit to Canada

        // Ensure both departure and arrival addresses have been entered
        if (!departureAddress.trim() || !arrivalAddress.trim()) {
            console.log('Both departure and arrival addresses are required.');
            return; // Exit the function if one of the addresses is missing
        }

        // Proceed with geocoding and routing
        geocoder.geocode({ q: departureAddress }, (result) => {
            if (result.items.length === 0) {
                alert('Departure address not found.');
                return;
            }
            const departure = result.items[0].position;

            geocoder.geocode({ q: arrivalAddress }, (result) => {
                if (result.items.length === 0) {
                    alert('Arrival address not found.');
                    return;
                }
                const destination = result.items[0].position;

                const routingParameters = {
                    routingMode: 'fast',
                    transportMode: 'car',
                    origin: `${departure.lat},${departure.lng}`,
                    destination: `${destination.lat},${destination.lng}`,
                    return: 'polyline',
                };

                const router = platform.getRoutingService(null, 8);
                router.calculateRoute(routingParameters, onResult, (error) => {
                    alert(error.message);
                });
            });
        });
    }

    
        
        function onResult(result) {
            if (result.routes.length) {
                let lineString = new H.geo.LineString();
        
                result.routes[0].sections.forEach((section) => {
                    // Decode the flexible polyline
                    let decodedPolyline = H.geo.LineString.fromFlexiblePolyline(section.polyline);
                    decodedPolyline.eachLatLngAlt((lat, lng, alt) => {
                        lineString.pushLatLngAlt(lat, lng, alt);
                    });
                });
        
                let polyline = new H.map.Polyline(lineString, {
                    style: { lineWidth: 4, strokeColor: 'rgba(0, 128, 255, 0.7)' }
                });
        
                map.addObject(polyline);
        
                // Assuming departure and arrival locations are properly defined in the route's sections
                const startLocation = result.routes[0].sections[0].departure.place.location;
                const endLocation = result.routes[0].sections[result.routes[0].sections.length - 1].arrival.place.location;
        
                const startMarker = new H.map.Marker({lat: startLocation.lat, lng: startLocation.lng});
                const endMarker = new H.map.Marker({lat: endLocation.lat, lng: endLocation.lng});
                map.addObjects([startMarker, endMarker]);
        
                map.getViewModel().setLookAtData({ bounds: polyline.getBoundingBox() });
            } else {
                alert('No route found.');
            }
        }
        


});