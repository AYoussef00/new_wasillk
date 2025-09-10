# Location API Documentation

## Overview
This API provides access to the company's geographical location information.

## Base URL
```
https://wasillk.com/api
```

## Endpoints

### Get Location Information

**Endpoint:** `GET /settings/location`

**Description:** Retrieves the company's geographical location including coordinates, address, and Google Maps link.

**Request:**
```http
GET /api/settings/location
Accept: application/json
```

**Response:**
```json
{
    "success": true,
    "data": {
        "coordinates": {
            "lat": 24.7136,
            "lng": 46.6753
        },
        "address": "الرياض، المملكة العربية السعودية",
        "google_maps_link": "https://maps.google.com/?q=24.7136,46.6753"
    }
}
```

**Response Fields:**
- `success` (boolean): Indicates if the request was successful
- `data` (object): Contains the location information
  - `coordinates` (object): Geographical coordinates
    - `lat` (number): Latitude coordinate
    - `lng` (number): Longitude coordinate
  - `address` (string): Human-readable address
  - `google_maps_link` (string): Direct link to Google Maps

**Error Response:**
```json
{
    "success": false,
    "message": "Error message here"
}
```

**HTTP Status Codes:**
- `200 OK`: Request successful
- `500 Internal Server Error`: Server error

## Usage Examples

### JavaScript/Fetch
```javascript
fetch('https://wasillk.com/api/settings/location')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const { lat, lng } = data.data.coordinates;
            const address = data.data.address;
            const mapsLink = data.data.google_maps_link;
            
            console.log('Coordinates:', lat, lng);
            console.log('Address:', address);
            console.log('Maps Link:', mapsLink);
            
            // Use coordinates for map integration
            initMap(lat, lng);
        }
    })
    .catch(error => console.error('Error:', error));
```

### Google Maps Integration
```javascript
function initMap(lat, lng) {
    const location = { lat: lat, lng: lng };
    
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: location,
    });
    
    const marker = new google.maps.Marker({
        position: location,
        map: map,
        title: "واصل لك لتأجير السيارات"
    });
}
```

### cURL
```bash
curl -X GET "https://wasillk.com/api/settings/location" \
     -H "Accept: application/json"
```

### PHP
```php
$response = file_get_contents('https://wasillk.com/api/settings/location');
$data = json_decode($response, true);

if ($data['success']) {
    $lat = $data['data']['coordinates']['lat'];
    $lng = $data['data']['coordinates']['lng'];
    $address = $data['data']['address'];
    $mapsLink = $data['data']['google_maps_link'];
    
    echo "Location: $address";
    echo "Coordinates: $lat, $lng";
}
```

### React Component Example
```jsx
import React, { useState, useEffect } from 'react';

const LocationComponent = () => {
    const [location, setLocation] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetch('https://wasillk.com/api/settings/location')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    setLocation(data.data);
                }
                setLoading(false);
            })
            .catch(error => {
                console.error('Error fetching location:', error);
                setLoading(false);
            });
    }, []);

    if (loading) return <div>Loading location...</div>;
    if (!location) return <div>Error loading location</div>;

    return (
        <div>
            <h3>موقعنا</h3>
            <p>{location.address}</p>
            <p>الإحداثيات: {location.coordinates.lat}, {location.coordinates.lng}</p>
            <a href={location.google_maps_link} target="_blank" rel="noopener noreferrer">
                عرض على خرائط جوجل
            </a>
        </div>
    );
};
```

## Use Cases

1. **Map Integration**: Use coordinates to display location on maps
2. **Contact Pages**: Display address and maps link
3. **Mobile Apps**: Get location for navigation features
4. **Website Headers**: Show location in contact information
5. **Booking Systems**: Use location for pickup/delivery services

## Notes
- This API does not require authentication
- Coordinates are in decimal degrees format
- Default location is set to Riyadh, Saudi Arabia
- The API returns default values if no settings are configured
- Location can be updated through the admin settings panel at `/settings`
- Google Maps link opens directly to the location
