# Test task for LuckyTrip from Ihor Kucherenko

## Installation (Linux)

Clone repository. Run command:

```bash
cp .env.example .env
```

Run command to get up and running the project:
```bash
docker-compose up -d
```

Then install all dependencies:

```bash
docker-compose run lt-app composer install --ignore-platform-reqs
```

Then run migrations:

```bash
docker-compose run lt-app php artisan migrate
```

To seed database you can run:

```bash
docker-compose run lt-app php artisan db:seed
```

## API endpoints:

Documentation to API endpoints is located in project's "/doc" folder.

There is a Postman collection in the project root called "LuckyTrip.postman_collection.json" so you can import
and test using even it.

Have fun and Happy checking! :))
