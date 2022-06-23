## orgaapp

    git clone https://github.com/GaetanLgt/orgaapp.git
____

    composer i
____

    cp .env .env.local
=> uncomment and configure the mysql connection
=> add DSN's config : 
  ###> Mailer ###
  MAILER_DSN=smtp://orgaapp_maildev:25
  ###< Mailer ###
____    

    php bin/console make:migration
____    

    php bin/console doctrine:migrations:migrate
____    

    php bin/console doctrine:fixtures:load
____

    php bin/console lexik:jwt:generate-keypair
____

API is on localhost:{port}/api

You can use postman or insomnia to request a JWT, then you can send request.
