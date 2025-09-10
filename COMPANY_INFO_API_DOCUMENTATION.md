# Company Information API Documentation

## Overview
This API provides access to company contact information including address, phone number, and WhatsApp number.

## Base URL
```
http://127.0.0.1:8000/api
```

## Endpoints

### Get Company Contact Information

#### Request
```http
GET /api/settings/contact
```

#### Headers
```
Accept: application/json
Content-Type: application/json
```

#### Response
```json
{
  "success": true,
  "data": {
    "phone": "+966535815072",
    "whatsapp": "+966535815072",
    "email": "info@wasillk.com",
    "address": "الدرعية - طريق الأمير عبدالله بن عبدالرحمن، الرياض، المملكة العربية السعودية",
    "google_maps_link": "https://maps.app.goo.gl/J1FPhWPzNBLq8qXC9?g_st=iw"
  }
}
```

#### Response Fields
| Field | Type | Description |
|-------|------|-------------|
| `success` | boolean | Indicates if the request was successful |
| `data.phone` | string | Company phone number |
| `data.whatsapp` | string | Company WhatsApp number |
| `data.email` | string | Company email address |
| `data.address` | string | Company physical address (in Arabic) |
| `data.google_maps_link` | string | Google Maps link to company location |

## Usage Examples

### cURL
```bash
curl -X GET "http://127.0.0.1:8000/api/settings/contact" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### JavaScript (Fetch)
```javascript
fetch('http://127.0.0.1:8000/api/settings/contact', {
  method: 'GET',
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  }
})
.then(response => response.json())
.then(data => {
  console.log('Company Info:', data.data);
  console.log('Phone:', data.data.phone);
  console.log('WhatsApp:', data.data.whatsapp);
  console.log('Address:', data.data.address);
});
```

### PHP
```php
$response = file_get_contents('http://127.0.0.1:8000/api/settings/contact');
$data = json_decode($response, true);

if ($data['success']) {
    $companyInfo = $data['data'];
    echo "Phone: " . $companyInfo['phone'] . "\n";
    echo "WhatsApp: " . $companyInfo['whatsapp'] . "\n";
    echo "Address: " . $companyInfo['address'] . "\n";
}
```

### Python
```python
import requests

response = requests.get('http://127.0.0.1:8000/api/settings/contact')
data = response.json()

if data['success']:
    company_info = data['data']
    print(f"Phone: {company_info['phone']}")
    print(f"WhatsApp: {company_info['whatsapp']}")
    print(f"Address: {company_info['address']}")
```

## Error Handling

### Possible Error Responses
```json
{
  "success": false,
  "message": "Error message here"
}
```

## Implementation Details

### Controller
- **File**: `app/Http/Controllers/SettingsController.php`
- **Method**: `getContactInfo()`

### Model
- **File**: `app/Models/Settings.php`
- **Method**: `getSettings()`

### Route
- **File**: `routes/api.php`
- **Route**: `GET /api/settings/contact`

## Data Source
The company information is stored in the `settings` table in the database. If no settings exist, default values are created automatically.

## Notes
- This API does not require authentication
- All responses are in JSON format
- The address is provided in Arabic
- Phone numbers include country code (+966 for Saudi Arabia)
- The API returns a consistent response structure with `success` and `data` fields

## Last Updated
September 10, 2025
