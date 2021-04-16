# busbooking
a fleet-management system (bus-booking system)
# instruction to run local
- git clone https://github.com/fadywilliam/busbooking.git
- cd busbooking
# In Linux/Mac:
- cp .env.example .env
# In windows
- copy .env.example .env
# Create database in phpmyadmin and config 
# - DB_HOST=localhost && DB_USERNAME && DB_PASSWORD in .env file in root
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
