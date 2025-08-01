# Football live score application

- This is a simple football live score application which displays live score of an ongoing football match built using laravel.

## Features

1. Live match score update
2. Football team management
3. Football match management
4. Scoreboard(update match status, update match score)

## Technologies
1. Laravel 12
2. Laravel Reverb
3. Sqlite 
4. PHP 8.2
5. NPM
6. Composer

## Installation guide

1. **Clone the repository:**

```bash
git clone https://github.com/tharindu996/football-live-score-app.git
cd football-live-score-app
```

2. **Install PHP dependencies:**
```bash
composer install
```

3. **Copy environment file:**
 ```bash
cp .env.example .env
```
4. **Generate application key:**
```bash
php artisan key:generate
```

5.  **Run database migrations:**
```bash
php artisan migrate
```

6.  **Seed the database:**
```bash
php artisan db:seed
```

7.  **Install Node.js dependencies:**
```bash
npm install 
```

8. **Start the Laravel development server:**
```bash
composer run dev
```

9. **Run reverb server:**
```bash
php artisan reverb:start
```

10. **Run reverb server:**
```bash
php artisan reverb:start
```

11. **Run Laravel queue**
```bash
php artisan queue:work
```

The application should now be accessible at `http://127.0.0.1:8000`.

## Steps

1. Go to teams page and there you can add teams. From seeders teams are already added to database.

2. Next go to football matches page and from there you can set a match. 
When creating a new match it sets as an ongoing match. There can only be one ongoing match at one time.

3. After setting a match go to the home page and you can see ongoing match detail.

4. You can update match score and match status from scoreboard page.

## Project stucture

```
/ ------------------------------------------------------- index
/teams -------------------------------------------------- index,store,destroy 
/football-matches --------------------------------------- index,store,destroy
/scoreboard --------------------------------------------- index
/football-matches/{football_match}/update-score/{team} -- patch
/football-matches/{football_match}/update-status -------- patch
```

## Contact
- My name is **Tharindu Dissanayake**. I am a experienced Laravel developer. If you have any questions, feel free to reach out to me:

* **Email:** tharindudissanayake03@gmail.com
* **GitHub:** https://github.com/tharindu996

## License

This project is open-sourced software licensed under the [MIT License](LICENSE.md).

