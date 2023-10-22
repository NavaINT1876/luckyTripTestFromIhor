# Delete Airport

## [DELETE] /airports/{airportId}

### Parameters

- airportId - integer, required

### Example request:

```curl
curl --location --request DELETE 'http://localhost:3075/airports/113'
```

### Example response:

Status: 204 No Content

Body: empty

### Not found response:

```json
{
    "errors": "Not Found"
}
```

