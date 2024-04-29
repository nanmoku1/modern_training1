# セットアップ

composer install  
↓  
cp .env.example .env  
↓  
./vendor/bin/sail up -d  
↓  
./vendor/bin/sail php artisan key:generate  
↓  
./vendor/bin/sail artisan migrate  
↓  
./vendor/bin/sail npm install  
↓  
./vendor/bin/sail npm run build  
↓  
http://localhost:80/  

