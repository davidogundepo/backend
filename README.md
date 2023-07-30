#  JWT-based Authentication System - Backend
This is a JWT-based Authentication System developed using React and Symfony with LexikJWTAuthenticationBundle. The system allows users to register, login, and retrieve user information. Users can also update their name and address. The code prioritizes security and maintains high code quality for production readiness and post-launch support.


## Getting Started

These instructions will help you set up and run the project locally on your machine.

### Prerequisites
Before running the project, you need to have the following software installed:

- Docker: [Download Docker](https://www.docker.com/get-started)
- Node.js: [Download Node.js](https://nodejs.org/en/download/)
- Composer: [Download Composer](https://getcomposer.org/download/)

### Instaliing
Follow these steps to get the project up and running:

1. ### `git clone <https://github.com/davidogundepo/backend.git>`
2. ### `cd JWT-based-Authentication-System`

### Backend Setup
1. Navigate to the `backend` folder:
   ### `cd backend`

### `composer install`

2. Database Configuration: Create a MySQL database and update the **`.env`** file with your database credentials.
3. Run Migrations: Apply the database migrations to create the necessary tables:

### `php bin/console doctrine:migrations:migrate`

4. Start the Development Server: Run the following command to start the Symfony development server:

### `symfony server:start`

The backend will run on [http://localhost:8000](http://localhost:8000).


## Available Endpoints

The following endpoints are available for user registration, login, user update, and user information retrieval:

- **`POST /api/register`:** <span style="color: #008000;">_Register a new user_.</span>
- **`POST /api/login`:** <span style="color: #008000;">_Login with valid credentials and receive a JWT token._</span>
- **`PATCH /api/user/update`:** <span style="color: #008000;">_Update the user's name and address (authentication required)._</span>
- **`GET /api/user/info`:** <span style="color: #008000;">_Retrieve user information (authentication required)._</span>


## Authentication
This backend uses JSON Web Tokens (JWT) for user authentication. When logging in or registering, the server issues a JWT token that should be included in the **`Authorization`** header for authenticated requests.


## Error Handling
The backend handles errors and provides appropriate error messages in the response. Make sure to handle the error responses in the frontend to provide a smooth user experience.


## Testing
Unit tests have been written to ensure the critical functionality of the backend. To run the tests, navigate to the "backend" folder and execute the following command:
### `php bin/phpunit`


## Docker
This project can be containerized using Docker. In the "backend" folder, a **`Dockerfile`** has been provided to build the Symfony application into a container. Additionally, a **`docker-compose.yml`** file has been included in the root folder to orchestrate the backend and frontend containers.


## Learn More
To learn more about Symfony and PHP, check out the following documentation:

- **[Symphony documentatation](https://symfony.com/doc/current/index.html)**
- **[PHP documentation](https://www.php.net/docs.php)**

## Licence

This project is licensed under the **[MIT License](https://opensource.org/license/mit/)**
