
* When git clone 

*   composer update
    cp .env.example .env
    php artisan key:generate

* create db_name 
* change config DB_DATABASE in .env
* tạo db
php artisan migrate

* Tạo tài khoản 
php artisan db:seed --class=CreateUsersSeeder
* Tạo roles
php artisan db:seed --class=CreateRoleSeeder
* Set Role
php artisan db:seed --class=CreateRoleUsersSeeder

 php artisan storage:link

-- begin --
* chạy server
php artisan serve
