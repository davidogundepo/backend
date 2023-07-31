#  JWT-based Authentication System - Backend
This is a JWT-based Authentication System developed using React and Symfony with LexikJWTAuthenticationBundle. The system allows users to register, login, and retrieve user information. Users can also update their name and address. The code prioritizes security and maintains high code quality for production readiness and post-launch support.

## `N.B. This is for the Back-End Repository`

[Please check Frontend here](https://github.com/davidogundepo/frontend)


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

6. Enter a passphrase when generating the SSH keys, and update the `.env` file with the passphrase:
   ```
   JWT_PASSPHRASE=your_passphrase_here
   ```

7. Set the proper permissions for the SSH keys:
   ```
   chmod 644 config/jwt/public.pem
   chmod 600 config/jwt/private.pem
   ```

## Running the Application
1. Go back to the root folder of the project:
   ```
   cd ..
   ```
2. Use `docker-compose` to start both the backend and frontend:
   ```
   docker-compose up -d
   ```
   This command will build and start the containers. The -d flag runs the containers in detached mode.

3. Access the backend API:
   The Symfony backend API will be available at **`http://localhost:8000/api`**.


## Testing
The project includes comprehensive unit tests for critical functionality. To run the tests, follow these steps:

For Backend Tests:
```
cd backend
php bin/phpunit
```

## Built With
- **[React](https://reactjs.org/)** -  A JavaScript library for building user interfaces.
- **[Symfony](https://symfony.com)** - A PHP web application framework.
- **[LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle)** - A JWT authentication bundle for Symfony.
- **[Docker](https://www.docker.com)** - A platform for developing, shipping, and running applications in containers.

## Authors
- **[David Ogundepo](https://github.com/davidogundepo)**

## Licence
This project is licensed under the **[MIT License](https://opensource.org/license/mit/)**

## Acknowledgements
- **[John Mahood](https://www.linkedin.com/in/johnmahood2018/)** - For the job description and company overview.
- **[Pascal Marechal](https://github.com/PascalMarechal)** - For providing the job interview test and guidance.
- **[The Coaches' Voice Company](https://github.com/Jay-CoachesVoice)** - For reviewing and evaluating the project.
