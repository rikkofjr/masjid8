
## Install 

1. you can clone this repository or download as zip<br/>
    <code>
        git clone https://github.com/rikkofjr/masjid8.git
    </code>
    <br/>
2. copy .env file <br/>
    <code>cp .env.example .env</code> <br/>
3. generate key <br/>
    <code>php artisan key:generate</code> <br/>

4. configure your database at .env file <br/>
    ```php
    DB_CONNECTION=
    DB_HOST= 
    DB_PORT= 
    DB_DATABASE=your db name
    DB_USERNAME= 
    DB_PASSWORD= 
    ```
    <br/>

5. install dependencies <br/>
    <code>composer install</code><br/>
6. run npm <br/>
    ```bash
    Run on CLI
        1. npm install 
        2. npm run dev
        or 
        npm install && npm run dev 
    ```
7. Migrate Database
    <code>php artisan migrate</code>

8. Run Seeder
    <code>php artisan db:seed</code>

9. Run the server
    <code>php artisan serve</code>

8. Login Wth
    Username : admin 
    password : admin