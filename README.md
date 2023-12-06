# SOLATI API TEST

API for student consumption and management. Developed with Laravel 10 and Postgres.

## Clone and run project

To run the project correctly, the following steps are required:

- Clone project from repository

```bash
  git clone https://github.com/einerb/solati-api.git
```

- Enter the cloned project path

```bash
  cd solati-api
```

- Install dependencies required for the operation of the project (For this it is necessary to have [composer](https://getcomposer.org/download/) installed)

```bash
  composer install
```

- Configure the .env.example file and leave it .env, in this file add the environment variables according to the computer where the project will be cloned
- Create the database with name `solati`
- Generate a respective APP KEY for the project

```bash
  php artisan key:generate
```

- Generate migrations and run the seeder to add test data.

```bash
  php artisan migrate --seed
```

- And finally you can run the API with the following command:

```bash
  php artisan serve
```

## Authors

- [@einerb](https://github.com/einerb)
