
# Warehouse System API


This project was developed as part of the selection process for the **Software Engineer** position. The task was to create a **Warehouse System** using **Laravel 10** or later, managing **Users**, **Items**, and **Mutations**.

The application includes several key features, such as:

-   **CRUD operations** (Create, Read, Update, Delete) for managing **Users, Items, and Mutations** through a **REST API**.
-   **Authentication** using **Bearer Token** to secure all API endpoints.
-   Relationship between **Users**, **Items**, and **Mutations**, allowing mutation records to link back to specific items and users.
-   Endpoints to view **mutation history** for each item and each user, with responses in **JSON** format.

Additionally, the application is designed to be **deployed using Docker**, and the API documentation is created using **Postman**. The project has been uploaded to **GitHub** with a detailed installation guide, instructions on how to run the project, and a link to the Postman documentation.


## Table of Contents
1. [Introduction](#introduction) 
2. [API Documentation](#api-documentation) 
3.  [Deployment](#deployment) 
4. [Running Locally](#running-locally) 
5.  [Feedback](#feedback) 

## API Documentation
A detailed API documentation, including example requests and responses, can be found in the following link:  
[API Documentation Link](https://documenter.getpostman.com/view/12326491/2sAXjM3ra9)

You can visit this link to view the full documentation and test the API using Postman.

### Available Endpoints

1.  **Auth:**
    -   `POST /api/login` – Authenticate user and generate token.
	   -   `POST /api/register` – Register a new user.
	   - `POST /api/logout` – Logout the user
3.  **User Management:**
    
    -   `GET /api/users` – Retrieve list of all users.
    -   `GET /api/users/{id}` – Retrieve details of a specific user.
    -   `PUT /api/users/{id}` – Update a user’s details.
    -   `DELETE /api/users/{id}` – Delete a user.
4.  **Products Management:**
    
    -   `GET /api/products` – Retrieve list of all items.
    -   `POST /api/products` – Create a new item.
    -   `GET /api/products/{id}` – Retrieve details of a specific item.
    -   `PUT /api/products/{id}` – Update an item’s details.
    -   `DELETE /api/products/{id}` – Delete an item.
5.  **Mutation Management:**
    
    -   `GET /api/mutations` – Retrieve all mutations.
    -   `POST /api/mutations` – Create a new mutation.
    -   `GET /api/mutations/{id}` – Retrieve details of a specific mutation.
     -   `PUT /api/mutations/{id}` – Update an mutation details.
     -    `DELETE /api/mutations/{id}` – Delete an mutations .
    -   `GET /api/items/{id}/mutations` – Get mutation history for a specific item.
    -   `GET /api/users/{id}/mutations` – Get mutation history for a specific user.

## Deployment

The project is currently deployed and available online. You can access the live application at :

```bash
https://api.id-grow.msyaifullahalarief.my.id
```

### Running Locally

To run this project locally on your machine, follow these steps:

 **1. Clone the Repository**

Start by cloning the repository to your local machine:

```bash
git clone https://github.com/arief2020/Warehouse-ID-Grow.git
```

 **2. Navigate into the Project Directory**

Move into the project directory:

```bash
cd Warehouse-ID-Grow
```

**3. Copy .env**

Copy the example environment file:

```bash
cp .env.example .env
```
**4.  Run Composer**

Install the project dependencies using Composer:

```bash
composer install
```

**5. Setting database**

Open the `.env` file and update the database configuration:
```env
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dbidgrowdev
DB_USERNAME=root
DB_PASSWORD=
...
```
**6. Generate API Key**

Generate api key
```bash
php artisan key:generate
```
**7. Run Migration**

Run the database migrations:
```bash
php artisan migrate
```
**8. Run App**

Start the Laravel development server:
```bash
php artisan serve
```

### Running with Docker

To run this project with docker, follow these steps:

 **1. Clone the Repository**

Start by cloning the repository to your local machine:

```bash
git clone https://github.com/arief2020/Warehouse-ID-Grow.git
```

 **2. Navigate into the Project Directory**

Move into the project directory:

```bash
cd Warehouse-ID-Grow
```

**3. Copy .env**

Install the project dependencies using npm :

```bash
cp .env.example .env
```
**4.  Run Composer**

Install the project dependencies using Composer:

```bash
composer install
```

**5. Setting database**

Edit the `.env` file for Docker's database connection (ensure the `DB_HOST` matches the service name in your `docker-compose.yml`):
```env
...
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laraveluser
DB_PASSWORD=password
...
```
**6. Generate API Key**

Generate the application key:
```bash
php artisan key:generate
```
**7. Run App with Docker**

Build and start the app using Docker Compose:
```bash
docker-compose up -d --build
```
**8. Run Migration**
Open an interactive shell in the Laravel container:
```bash
docker exec -it laravel_id_grow sh
```
Run the migrations:
```bash
php artisan migrate
```

## Tech Stack

**Server:** Laravel

**Database:** MySQL

