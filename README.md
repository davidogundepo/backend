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

Clone this repository to your local machine:

```
git clone <repository_url>
cd JWT-based-Authentication-System
```

### Backend Setup
1. Navigate to the `backend` folder:
   ```
   cd backend
   ```

2. Install the Symfony dependencies:
   ```
   compose install
   ```
   
3. Set up the database and apply migrations:
   ```
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

4. Configure the database connection in the `.env` file:
   ```
   DATABASE_URL=mysql://db_user:db_password@db/mysql
   ```

5. Generate the SSH keys for LexikJWTAuthenticationBundle:
   ```
   mkdir -p config/jwt
   openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
   openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
   ```

6. Enter a passphrase when generating the SSH keys, and update the .env file with the passphrase:
   ```
   JWT_PASSPHRASE=your_passphrase_here
   ```

7. Set the proper permissions for the SSH keys:
   ```
   chmod 644 config/jwt/public.pem
   chmod 600 config/jwt/private.pem
   ```


## Testing
The project includes comprehensive unit tests for critical functionality. To run the tests, follow these steps:

For Backend Tests:
```
cd backend
php bin/phpunit
```

## Built With
- React
- Symfony
- LexikJWTAuthenticationBundle
- Docker


## Authors
- David Ogundepo


## Licence
This project is licensed under the **[MIT License](https://opensource.org/license/mit/)**

## Acknowledgements
- Acknow


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

