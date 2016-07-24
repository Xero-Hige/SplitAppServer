# SplitApp Backend Server

Backend API for SplitApp [SplitApp mobile app](https://github.com/Xero-Hige/SplitApp)

## Getting Started

Run `php artisan key:generate` to create the app key. Rename `.env.example` to `.env` and change values is `.env` as needed.

Run `docker-compose up -d` to start running the whole stack (Nginx, PHP, MySQL, phpMyAdmin). The API will be running on port 80 and phpMyAdmin on port 8080.