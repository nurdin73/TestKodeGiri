### REQUIREMENT FOR TEST 1
- Node JS latest version

### INSTALATION FOR TEST 1
- buka terminal pada project ini
- lalu jalankan node 1.js 

### REQUIREMENT FOR TEST 2
- min php7.3
- posgresSQL server
- Composer

### INSTALATION FOR TEST 2
- download project ini menggunakan command ``git clone https://github.com/nurdin73/TestKodeGiri``
- Setelah didownload. silahkan masuk ke project lalu jalankan command ``composer install`` atau ``composer update``
- setelah composer selesai dijalakan. Silahkan rubah atau copy file .env.example menjadi .env
- setelah berhasil di copy/rename, silahkan jalankan command ``php artisan key:generate``
- Lalu update file .env tadi dibagian
```
APP_URL=http://localhost:8000 atau url server
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=database pgsql
DB_USERNAME=username akun pqsql
DB_PASSWORD=password akun pqsql

L5_SWAGGER_CONST_HOST="${APP_URL}/api"
```
- Jangan lupa untuk membuat database di server pgsql terlebih dahulu untuk menyimpan data
- setelah semua konfigurasi selesai. silahkan jalankan command 
```
php artisan migrate:fresh --seed
```
- setelah migrate selesai. silahkan jalankan command `` php artisan serve ``
- Setelah berhasil running. silahkan buka browser favorit anda. lalu akses url http://localhost:8000/api/documentation