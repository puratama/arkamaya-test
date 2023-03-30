Instruksi
1. Clone repository terlebih dahulu
2. Setelah melakukan cloning, selanjutnya masuk ke dalam folder project
3. Buka command prompt lalu ketikkan composer install
4. Setelah menginstall composer, selanjutnya konfigurasi file .env
4.1. Buka file .env, jika file .env tidak ada maka salin file .env.example menjadi .env
4.2. Atur nama database
4.3. Atur username database dan password database jika diperlukan
4.4. Simpan file .env
5. Buatlah database terlebih dahulu dengan nama database yang sama seperti pada konfigurasi .env
6. Generate key dengan ketikkan php artisan key:generate
7. Migrate database dengan ketikkan php artisan migrate --seed
8. Jalankan project dengan ketikkan php artisan serve
9. Akses localhost:8000 pada browser