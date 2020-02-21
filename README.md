> ### Crawler Project (using Laravel)
>

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)


Clone the repository

    git clone git@github.com:murilorr90/laravel-crawler.git

Switch to the repo folder

    cd laravel-crawler

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

## API Specification

Full API Documentation

    access http://localhost:8000/docs
    
----------

# Code overview

## Dependencies

- [goutte](https://github.com/fabpot/goutte) - Goutte is a screen scraping and web crawling library for PHP.
- [aravel-apidoc-generator](https://github.com/mpociot/laravel-apidoc-generator) - Automatically generate your API documentation from your existing Laravel/Lumen/Dingo routes.

# Author

Murilo Rocha - <murilorr90@gmail.com>
