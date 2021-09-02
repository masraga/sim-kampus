# SIM Kampus

## Apa itu aplikasi sim kampus ?

SIM kampus adalah aplikasi berbasis codeigniter 4, yang mana didalamnya terdapat beberapa fitur untuk menyelesaikan beberapa mahasalah kampus dengan cepat, contohnya mengisi data tagihan setiap mahasiswa tanpa harus mengetik ulang

## Instalasi & setup

* Clone code ini
* buka `php.ini` dan hapus komentar untuk ekstensi `intl` lalu restart web service kamu
* ekstrak code yang baru diclone tadi di `C:\xampp\htdocs` ( jika menggunakan xampp pada windows )
* buka project yang baru di ekstrak tadi, lalu rename file `env` menjadi `.env`
* Pastikan komputer sudah terinstall [composer](https://getcomposer.org/) , buka termimal / cmd di project kamu, lalu jalankan :
    ```sh
    composer install
    ```
* Jika composer sudah selesai memproses, selanjutnya adalah membuat database untuk project kita, jalankan pada cli
    ```sh
    php spark db:create interview
    php spark migrate
    php spark db:seed DataUser
    php spark db:seed DataMahasiswa
    ```
* setelah semua selesai jalan project kita melalui cmd
    ```sh
    php spark serve
    ```
* biasanya akan muncul `CodeIgniter development server started on http://localhost:8080`, lalu buka browser dan ketikkan `http://localhost:8080`

## Pemakaian aplikasi
Aplikasi ini pada dasarnya memiliki 3 role yaitu admin, bendahara, mahasiswa. Adapun beberapa user credential yang dapat digunakan adalah :

**admin**
email       : admin@gmail.com
password    : admin

**bendahara**
email       : bendahara@gmail.com
password    : bendahara

**mahasiswa**
email       : real.ragamulia@gmail.com
password    : raga

**Note :** Jika kamu mengubah base url di sistem ci4 , maka kamu juga harus mensinkronkan base url baru tersebut di `public/url-helper.js`