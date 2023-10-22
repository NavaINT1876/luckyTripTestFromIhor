# Get Airport

## [GET] /airports/{airportId}

### Parameters

- airportId - integer, required

### Example request:

```curl
curl --location 'http://localhost:3075/airports/113'
```

### Example response:

Status: 200 OK

Body: 

```json
{
    "id": 113,
    "name": "Gracie Cole",
    "iata_code": "Y7F",
    "latitude": "-88.4185020",
    "longitude": "-110.0125520",
    "description": "Cumque amet voluptatem aliquam ea sequi. Quod nulla facere autem.",
    "terms_and_conditions": "Incidunt quo et doloribus ut deleniti cum aut. Occaecati recusandae est eaque iusto expedita quia. Earum sint quidem veritatis hic ex.",
    "created_at": "2023-10-22T21:13:43.000000Z",
    "updated_at": "2023-10-22T21:13:43.000000Z",
    "translations": [
        {
            "id": 248,
            "airport_id": 113,
            "language": "af",
            "text": "Sylvester Torp",
            "created_at": "2023-10-22T21:13:43.000000Z",
            "updated_at": "2023-10-22T21:13:43.000000Z"
        },
        {
            "id": 247,
            "airport_id": 113,
            "language": "en",
            "text": "Daija Hilpert",
            "created_at": "2023-10-22T21:13:43.000000Z",
            "updated_at": "2023-10-22T21:13:43.000000Z"
        },
        {
            "id": 249,
            "airport_id": 113,
            "language": "es",
            "text": "Mrs. Maddison Konopelski",
            "created_at": "2023-10-22T21:13:43.000000Z",
            "updated_at": "2023-10-22T21:13:43.000000Z"
        }
    ]
}
```

### Not found response:

```json
{
    "errors": "Not Found"
}
```

