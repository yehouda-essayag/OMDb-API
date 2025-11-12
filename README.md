# OMDb-API
A Laravel-based API project for managing and fetching movie data from OMDb.

## Features
- Fetch movies by title or IMDb ID
- Filter movies by genre
- Add and update movie entries
- Simple RESTful API built with Laravel

## Requirements
- PHP 7.4.33+
- Composer
- SQLite
- Laravel dependencies (installed via Composer)

## Setup Instructions
```bash
git clone https://github.com/yehouda-essayag/OMDb-API.git
cd OMDb-API
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

```


1. **Clone the repository:**
```bash
git clone https://github.com/yehouda-essayag/OMDb-API.git
cd OMDb-API
```

2. **Install dependencies:**
```bash
composer install
```

3. **Set up environment:**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Run migrations:**
```bash
php artisan migrate
```

5. **Run migrations:**
```bash
npm install 
npm run dev 
```

6. **Start the application:**
```bash
php artisan serve
```

7. **Access the API:**
```bash
http://localhost:8000
```


| Method | Endpoint                  | Description              |
| ------ | ------------------------- | ----------------------   |
| GET    | /movies                   | Get all movies           |
| GET    | /movies/{id}              | Get a movie by ID        |
| GET    | /movies/by-genre/{id}     | Filter movies by genre id|
| POST   | /movies                   | Create a new movie       |
| PUT    | /movies/{id}              | Update a movie           |
