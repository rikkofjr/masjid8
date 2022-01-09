
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
    <code>
    DB_CONNECTION= <br/>
    DB_HOST= <br/>
    DB_PORT= <br/>
    DB_DATABASE=your db name <br/>
    DB_USERNAME= <br/>
    DB_PASSWORD= <br/>
    </code><br/>

5. install dependencies <br/>
    <code>composer install</code><br/>
6. run npm <br/>
    <code>
        1. npm install <br/>
        2. npm run dev <br/>
        or <br/>
        npm install && npm run dev 
    </code>
7. Run the server
    <code>php artisan serve</code>