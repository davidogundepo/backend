#  JWT-based Authentication System - Backend
 This backend project is part of the JWT-based Authentication System, which provides a secure user authentication and authorization mechanism. The backend is built using Symfony, PHP, and MySQL.

## Getting Started

To set up and run the backend, follow the steps below:

1. Install dependencies: Navigate to the "backend" folder and run the following command to install required dependencies:

### `composer install`

2. Database Configuration: Create a MySQL database and update the **.env** file with your database credentials.
3. Run Migrations: Apply the database migrations to create the necessary tables:

### `php bin/console doctrine:migrations:migrate`

4. Start the Development Server: Run the following command to start the Symfony development server:

### `symfony server:start`

The backend will run on [http://localhost:8000](http://localhost:8000).


# Available Endpoints

The following endpoints are available for user registration, login, user update, and user information retrieval:

- POST /api/register: Register a new user.
- POST /api/register:  Login with valid credentials and receive a JWT token.
- PATCH /api/user/update: Update the user's name and address (authentication required).
- GET /api/user/info: Retrieve user information (authentication required).


# Authentication
This backend uses JSON Web Tokens (JWT) for user authentication. When logging in or registering, the server issues a JWT token that should be included in the **Authorization** header for authenticated requests.


# Error Handling
The backend handles errors and provides appropriate error messages in the response. Make sure to handle the error responses in the frontend to provide a smooth user experience.


# Testing
Unit tests have been written to ensure the critical functionality of the backend. To run the tests, navigate to the "backend" folder and execute the following command:
### `php bin/phpunit`


# Docker
This project can be containerized using Docker. In the "backend" folder, a **Dockerfile** has been provided to build the Symfony application into a container. Additionally, a **docker-compose.yml** file has been included in the root folder to orchestrate the backend and frontend containers.


# Learn More
To learn more about Symfony and PHP, check out the following documentation:

- **Symphony documentatation** [running tests](https://symfony.com/doc/current/index.html)
- **PHP documentation** [running tests](https://www.php.net/docs.php)

# Licence

This project is licensed under the **MIT License**. [running tests](https://opensource.org/license/mit/)
