# busbooking
a fleet-management system (bus-booking system)
# instruction to run local
- git clone https://github.com/fadywilliam/busbooking.git
- cd busbooking
# In Linux/Mac:
- cp .env.example .env
# In windows
- copy .env.example .env
# Create DB in phpmyadmin and config it in .env
- DB_HOST=localhost
- DB_USERNAME=root
- DB_PASSWORD=

# then
- composer install
- php artisan key:generate
- php artisan migrate:fresh --seed
- php artisan serve
# local server domain ex:http://127.0.0.1:8000/
- click login
# Access admin panel by using dumy data
# 1- as admin access permission
- email:admin@admin.com
- password:admin1234
# 2- as user access permission
- email:test@test.com
- password:test1234
