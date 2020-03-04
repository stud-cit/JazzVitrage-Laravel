# Music school. Fest page

# Client:
## Installation
* Run `npm install`

## Running the app
* Run `npm run watch`

## Build the app
* Run `npm run prod`

# Server:
## Installation:
* Copy `.env.example` to `.env`
* Configure `.env`
* Run `composer install`
* Run `php artisan key:generate`
* Run `php artisan migrate`
* Run `php artisan db:seed`

## Commands after updates:
* Run `composer dump-autoload` (optional)
* Run `php artisan migrate:fresh --seed`