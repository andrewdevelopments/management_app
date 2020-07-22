<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Instalation

Task Management Application

- make a new project in your Laragon, XAMPP, MAMP app
- go to project folder
- git clone https://github.com/andrewdevelopments/management_app.git . (added a dot at the end to extract only the subfolders)
- composer install
- copy .env.example to .env
- php artisan key:generate

- open .env file and replace 
- DB_DATABASE=yourdatabase
- DB_USERNAME=yourusernameifyouhave
- DB_PASSWORD=yourpasswordifyouhave

- php artisan migrate:fresh
- php artisan db:seed

Now you can open the app or run php artisan serve

If you want to have all the permissions you need to login with: <strong>admin@admin.ro</strong> and the password is <strong>admin</strong>
If you want to see the user side, login with: <strong>user@user.ro</strong> and the password is: <strong>user</strong>
Also all the user from this seed have the  password "secret"