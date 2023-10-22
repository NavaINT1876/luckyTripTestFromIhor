# PUT Airport

## [PUT]  /airports/{airportId}

### Parameters

```code
"name" - string (3-60 characters), required
"iata_code" - string (3 characters), required
"latitude" - decimal, between -90 and 90, required
"longitude" - decimal, between -180 and 190, required
"description" - string (100-500 characters), required
"terms_and_conditions" - string (100-500 characters), optional
"name_translations" - array of translations like the following:  "[..., {"language": "de", "text": "FLUGHAFEN123"}, ...]"
```

### Example request:

```curl
curl --location --request PUT 'http://localhost:3075/airports/113' \
--header 'Content-Type: application/json' \
--data '{
    "name": "err444",
    "iata_code": "2e2",
    "latitude": 80.89745145,
    "longitude": 100,
    "description": "The description field is required. The description field is required.The description field is required.",
    "terms_and_conditions": "The description field is required. The description field is required.The description field is required.",
    "name_translations": [
        {"language": "de", "text": "FLUGHAFEN123"},
        {"language": "ru", "text": "AEROPORT123"}
    ]
}
'
```

### Example response:
Status - 204 No Content.

Body - empty. 

### Not found response:

```json
{
    "errors": "Not Found"
}
```

