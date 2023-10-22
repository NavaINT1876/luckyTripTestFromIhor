# GET Airports list

## [GET] /airports

### Parameters

The following parameters can be passed in query string:
```code
"name" - string, optional
"latitude" - decimal, between -90 and 90, optional (required if "longitude" is provided)
"longitude" - decimal, between -180 and 190, optional (required if "longitude" is provided)
"sort" - string, optional
```

### Example request:

```curl
curl --location 'http://localhost:3075/airports'
```

or

```curl
curl --location 'http://localhost:3075/airports?name=Emelie%20Ondricka'
```

or
```curl
curl --location 'http://localhost:3075/airports?latitude=-83.6808890&longitude=142.2080580&sort=DESC'
```

### Example response:
Status - 200 OK.

Body:

```json
{
    "airports": [
        {
            "id": 114,
            "name": "Emelie Ondricka",
            "iata_code": "AS7",
            "latitude": "-83.6808890",
            "longitude": "142.2080580",
            "description": "Facilis ipsum a quod recusandae odio. Quis aliquid corrupti ex voluptas ea dolore. Ea ipsam autem accusantium error nostrum. Officia voluptatem magnam",
            "terms_and_conditions": "Quis et laboriosam dolores quo minima. Repudiandae velit qui quo fugit. Rerum et animi et voluptatem cupiditate. Molestiae voluptatem autem vel volupt",
            "created_at": "2023-10-22T21:13:43.000000Z",
            "updated_at": "2023-10-22T21:13:43.000000Z",
            "translations": [
                {
                    "id": 250,
                    "airport_id": 114,
                    "language": "ar",
                    "text": "Mr. Patrick Grady I",
                    "created_at": "2023-10-22T21:13:43.000000Z",
                    "updated_at": "2023-10-22T21:13:43.000000Z"
                },
                {
                    "id": 252,
                    "airport_id": 114,
                    "language": "es",
                    "text": "Mr. Stanford Gulgowski",
                    "created_at": "2023-10-22T21:13:43.000000Z",
                    "updated_at": "2023-10-22T21:13:43.000000Z"
                },
                {
                    "id": 251,
                    "airport_id": 114,
                    "language": "so",
                    "text": "Olen Cassin",
                    "created_at": "2023-10-22T21:13:43.000000Z",
                    "updated_at": "2023-10-22T21:13:43.000000Z"
                }
            ]
        },
        {...},
        {...}
    ]
}
```




