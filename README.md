<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Instalation

Task Management Application

- git clone https://github.com/andrewdevelopments/management_app.git .
- composer install
- copy .env.example to .env
- php artisan key:generate

- open .env file and replace 
- DB_DATABASE=yourdatabase
- DB_USERNAME=yourusernameifyouhave
- DB_PASSWORD=yourpasswordifyouhave

- php artisan migrate:fresh
- php artisan db:seed

- If you want to have all the permissions you need to login with <strong>admin@admin.ro</strong> and <strong>password</strong>
- If you want to see the user side, login with <strong>user@user.ro</strong> <strong>user</strong>
- Also all the user from this seed have the  password "secret"