# Task Manager API

## Requirements

`Php ^8.2 Installed Locally`

`Composer 2.5.4 or Higher`

`MySQL & Server (ex: Laragon)`

## Installation & Running the App

Clone the project

```
git clone https://github.com/EssaadaniYounes/task-manager-api
```

Create .env file and fill the database information

Run the migration

```
php artisan migrate
```

Insert fake data for testing

```
php artisan db:seed
```

Run the Application

```
php artisan serve
```

## Routes

#### Authentication

-   `POST :/auth/register` Create a user account

-   `POST :/auth/login` Login to the application

#### Tasks

-   `Get :/tasks` Get the user tasks

    -   sort tasks : /?due_date=asc|desc
    -   filter tasks : /?status=pending|completed..

-   `POST :/tasks` Create task for the authenticated user
-   `GET :/tasks/:id` Get task details
-   `PUT :/tasks/:id` Update the task
-   `PUT :/tasks/:id/mark-completed` Set task status to completed
-   `DELETE :/tasks/:id` Delete a task by a given Id
