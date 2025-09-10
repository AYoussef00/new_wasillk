# Titles API Documentation

## Overview
This API endpoint provides access to the main title and sub title settings for the Wasilk car rental service.

## Endpoint

### GET /api/settings/titles

Retrieves the main title and sub title from the settings.

#### Request

```http
GET /api/settings/titles
Accept: application/json
```

#### Response

**Success Response (200 OK):**

```json
{
    "success": true,
    "data": {
        "main_title": "واصل لك لتأجير السيارات",
        "sub_title": "أفضل خدمة تأجير سيارات في المملكة"
    }
}
```

#### Response Fields

| Field | Type | Description |
|-------|------|-------------|
| `success` | boolean | Indicates if the request was successful |
| `data` | object | Contains the title information |
| `data.main_title` | string | The main title of the service |
| `data.sub_title` | string | The subtitle/description of the service |

#### Default Values

If no custom titles are set in the database, the API returns these default values:
- **main_title**: "واصل لك لتأجير السيارات"
- **sub_title**: "أفضل خدمة تأجير سيارات في المملكة"

## Usage Examples

### cURL Example

```bash
curl -X GET "http://127.0.0.1:8000/api/settings/titles" \
     -H "Accept: application/json" | python3 -m json.tool
```

### JavaScript Example

```javascript
fetch('/api/settings/titles')
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log('Main Title:', data.data.main_title);
      console.log('Sub Title:', data.data.sub_title);
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
```

### PHP Example

```php
$response = file_get_contents('http://127.0.0.1:8000/api/settings/titles');
$data = json_decode($response, true);

if ($data['success']) {
    $mainTitle = $data['data']['main_title'];
    $subTitle = $data['data']['sub_title'];
    
    echo "Main Title: " . $mainTitle . "\n";
    echo "Sub Title: " . $subTitle . "\n";
}
```

### Vue.js Example

```javascript
// Using Axios
import axios from 'axios';

async function getTitles() {
  try {
    const response = await axios.get('/api/settings/titles');
    if (response.data.success) {
      const { main_title, sub_title } = response.data.data;
      return { main_title, sub_title };
    }
  } catch (error) {
    console.error('Error fetching titles:', error);
  }
}

// Using fetch
async function getTitles() {
  try {
    const response = await fetch('/api/settings/titles');
    const data = await response.json();
    
    if (data.success) {
      return data.data;
    }
  } catch (error) {
    console.error('Error fetching titles:', error);
  }
}
```

## Error Handling

The API follows standard HTTP status codes:

- **200 OK**: Request successful
- **500 Internal Server Error**: Server error occurred

### Error Response Format

```json
{
    "success": false,
    "message": "Error message description"
}
```

## Integration Notes

1. **Caching**: Consider implementing client-side caching for better performance
2. **Fallback**: Always provide fallback values in case the API is unavailable
3. **Updates**: Titles can be updated through the admin dashboard at `/dashboard/settings`

## Related APIs

- [Policies API](./POLICIES_API_DOCUMENTATION.md) - Get cancellation policy, insurance info, and rental terms
- [Location API](./LOCATION_API_DOCUMENTATION.md) - Get location coordinates, address, and Google Maps link

## Database Schema

The titles are stored in the `settings` table:

```sql
CREATE TABLE settings (
    id BIGINT PRIMARY KEY,
    main_title VARCHAR(255) NULL,
    sub_title VARCHAR(255) NULL,
    -- other fields...
);
```

## Version History

- **v1.0** (2025-01-10): Initial release with basic title retrieval functionality

---

**Base URL**: `http://127.0.0.1:8000`  
**API Version**: v1  
**Last Updated**: January 10, 2025
