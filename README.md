# Bemo task
This is a simple Trello-like application with drag and drop functionality.
# Requirements
```sh
    "php": "^8.0",
    "mysql-dump"
```
# Setting it up
These are the steps to get the app up and running. Once you're using the app.

1. Clone the repository
2. `composer install`
3. `npm run dev`
4. Rename `.env.example` to `.env` 
5. run `php artisan key:generate`
6. Update database credentials in `.env` with your local database credentials 
7. Run migrations: `php artisan migrate`
8. Run `php artisan test`

