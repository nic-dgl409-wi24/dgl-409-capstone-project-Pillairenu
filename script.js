'use strict';


document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('departure').addEventListener('change', departureLocation);
    document.getElementById('arrival').addEventListener('change', arrivalLocation);


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


    let platform = new H.service.Platform({
        'apikey': 'bc1jXDa0GtxqIOL1LvdT7FAWzUdaoZ24NYOQuTR3NtY'
      });
// Initialize a map - not shown here, refer to previous examples

function convertLocationToCoordinates(locationName) {
    let  geocoder = platform.getSearchService();
    
    geocoder.geocode({
        q: locationName
    }, (result) => {
        // Filter results by region
        const regions = ['Comox', 'Courtenay', 'Campbell River'];
        const filteredResults = filterResultsByRegion(result, regions);

        if (filteredResults.length > 0) {
            // Use the first filtered result as the location
            const location = filteredResults[0].position;

            // Log the location for debugging purposes
            console.log(`Filtered Location: ${location.lat}, ${location.lng}`);

            // Example: Set map center to the location and add a marker
            // map.setCenter(location);
            // map.setZoom(14);
            // var marker = new H.map.Marker(location);
            // map.addObject(marker);
        } else {
            console.error('No results found for the entered location in the specified regions.');
        }
    }, (error) => {
        console.error('Error:', error);
    });
}

function filterResultsByRegion(data, regions) {
    return data.items.filter(item => 
        regions.includes(item.address.city) || regions.includes(item.address.county)
    ).map(item => item.position);
}
//     function convertLocationToCoordinates(locationName) {
//         const geocodingApiUrl = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(locationName)}&format=json`;
    
//         // Make API request
//         fetch(geocodingApiUrl)
//             .then((response) => response.json())
//             .then((data) => {
//             // Check if the API returned any results
//               if (data && data.length > 0) {
//               // Extract latitude and longitude from the first result
//                 const latitude = data[0].lat;
//                 const longitude = data[0].lon;
//                 console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);
               
//                 // getWeatherData(latitude, longitude, date);
//             } else {
//                 // If no results, display an error message in the HTML element
//                 document.getElementById('error-message').textContent = 'No results found for the entered location.';
//             }
//         })
//         .catch((error) => {
//             // If an error occurs, display it in the HTML element
//             document.getElementById('error-message').textContent = `Error converting location to coordinates: ${error}`;
//         });
// }



});