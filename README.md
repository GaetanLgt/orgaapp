# orgaapp

- git clone https://github.com/GaetanLgt/orgaapp.git

- composer i

- cp .env .env.local => uncomment and configure the mysql connection

- php bin/console make:migration
- php bin/console doctrine:migrations:migrate
- php bin/console doctrine:fixtures:load

API is on localhost:{port}/api

You can use postman or insomnia to request a JWT, then you can send request.
