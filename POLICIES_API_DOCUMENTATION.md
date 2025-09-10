# Policies API Documentation

## Overview
This API provides access to company policies and terms stored in the settings.

## Base URL
```
https//wasillk.com/api
```

## Endpoints

### Get Policies and Terms

**Endpoint:** `GET /settings/policies`

**Description:** Retrieves the company's policies and terms including cancellation policy, insurance information, and rental terms.

**Request:**
```http
GET /api/settings/policies
Accept: application/json
```

**Response:**
```json
{
    "success": true,
    "data": {
        "cancellation_policy": "يمكن إلغاء الحجز قبل 24 ساعة من تاريخ الاستلام بدون رسوم. في حالة الإلغاء خلال 24 ساعة، سيتم خصم 50% من المبلغ.",
        "insurance_info": "جميع السيارات مؤمنة بالكامل ضد الحوادث والسرقة. التأمين يشمل المسؤولية المدنية والضرر المادي.",
        "rental_terms": "يجب أن يكون عمر المستأجر 21 سنة أو أكثر. يجب تقديم رخصة قيادة سارية المفعول وهوية شخصية. ممنوع التدخين في السيارة."
    }
}
```

**Response Fields:**
- `success` (boolean): Indicates if the request was successful
- `data` (object): Contains the policies and terms
  - `cancellation_policy` (string): Company's cancellation policy
  - `insurance_info` (string): Insurance information and coverage details
  - `rental_terms` (string): Terms and conditions for car rental

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
fetch('http://127.0.0.1:8000/api/settings/policies')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Cancellation Policy:', data.data.cancellation_policy);
            console.log('Insurance Info:', data.data.insurance_info);
            console.log('Rental Terms:', data.data.rental_terms);
        }
    })
    .catch(error => console.error('Error:', error));
```

### cURL
```bash
curl -X GET "http://127.0.0.1:8000/api/settings/policies" \
     -H "Accept: application/json"
```

### PHP
```php
$response = file_get_contents('http://127.0.0.1:8000/api/settings/policies');
$data = json_decode($response, true);

if ($data['success']) {
    $cancellationPolicy = $data['data']['cancellation_policy'];
    $insuranceInfo = $data['data']['insurance_info'];
    $rentalTerms = $data['data']['rental_terms'];
}
```

## Notes
- This API does not require authentication
- All text content is in Arabic
- The API returns default values if no settings are configured
- Content can be updated through the admin settings panel at `/settings`
