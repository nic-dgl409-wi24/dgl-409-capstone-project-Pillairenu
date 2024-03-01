'use strict';


document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('departure').addEventListener('input', departureLocation);
    document.getElementById('arrival').addEventListener('input', arrivalLocation);


    function departureLocation() {
        let departureValue = document.getElementById('departure').value;
        console.log(departureValue);
        convertLocationToCoordinates(departureValue);
    }
    function arrivalLocation() {
        let arrivalValue = document.getElementById('arrival').value;
        console.log(arrivalValue);
        convertLocationToCoordinates(arrivalValue);
    }

    function convertLocationToCoordinates(locationName) {
        const geocodingApiUrl = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(locationName)}&format=json`;
    
        // Make API request
        fetch(geocodingApiUrl)
            .then((response) => response.json())
            .then((data) => {
            // Check if the API returned any results
              if (data && data.length > 0) {
              // Extract latitude and longitude from the first result
                const latitude = data[0].lat;
                const longitude = data[0].lon;
                console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);
               
                // getWeatherData(latitude, longitude, date);
              } else {
                console.error('No results found for the entered location.');
              }
            })
            .catch((error) => console.error('Error converting location to coordinates:', error));
      }




});