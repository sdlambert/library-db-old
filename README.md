## Library DB

A simple [Laravel](https://laravel.com/) app for keeping track of my physical library.

## Setup

Update your `.env` file with any appropriate environment variables.

    DB_CONNECTION=sqlite
    DB_DATABASE=library-db.sqlite

Run the following commands if starting up the app for the first time.

    php artisan migrate
    php artisan key:generate

### Configuring IDE Helper

Run the following commands to configure or reset the IDE Helper

    php artisan clear-compiled
    php artisan ide-helper:generate
    php artisan ide-helper:models -n
    php artisan ide-helper:meta

## Local Development

Run the following commands for local development:

    php artisan serve
    npm run watch
