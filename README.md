Before you can run the application you need to configure the .env file in the root directory of the application to point to the database. Then run the following commands in order:

1. "composer update" to install the project dependencies.
2. "php artisan migrate" to run all migrations.
3. "php artisan db:seed" to run all the seeders and generate dummy data.
4. "php artisan serve" to serve the application.

Then you should be able to login using the following credentials:
- Email: admin@example.com
- Password: admin
