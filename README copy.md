Overview

This project is a web application built using Laravel for the backend and React for the frontend. It implements authentication with Laravel Sanctum and provides an API endpoint /api/contact/email to get sender data, simulating the Outlook context for login.
Technology Stack

    Backend: Laravel (PHP framework)

    Frontend: React (JavaScript library)

    Authentication: Laravel Sanctum

    Containerization: Docker (Dockerfile)

Setup Instructions

1. Install Docker

Ensure that Docker is installed on your system. You can follow the instructions below to install it:
For Docker:

    Visit Docker Install Guide for installation steps.

After installation, you can verify that Docker is installed using the following command:

docker --version

2. Clone the Repository

Clone the project repository from GitHub:

git clone <repository-url>
cd <repository-name>

3. Build and Run the Containers

To build and run the Docker container for both the backend and frontend, follow these steps:

    Navigate to the project root directory where the Dockerfile is located.

    Build the Docker container:

docker build -t laravel-react-app .

After the build process is complete, run the container:

    docker run -p 8000:8000 -p 3000:3000 laravel-react-app

    The application will now be accessible at:

        Backend: http://localhost:8000

        Frontend: http://localhost:3000

4. Setting Up Environment Variables

Make sure to set up the environment variables for the Laravel application. Copy .env.example to .env and configure your database and mail settings as needed:

cp .env.example .env

Then, generate the Laravel application key:

docker exec -it <container-name> php artisan key:generate

5. Authentication Flow

This project uses Laravel Sanctum for authentication. Here’s how the authentication flow works:

    The user logs in with email and password (andre@gmail.com / andre#777@).

    Laravel Sanctum generates a token that is returned and stored in the frontend (localStorage or cookies).

    The frontend uses this token to authenticate subsequent API requests, such as retrieving sender data.

Login Credentials:

    Email: andre@gmail.com

    Password: andre#777@

6.  Testing Login Functionality and API Calls
    Testing Login:

        Open the React app at http://localhost:3000.

        Use the login form with the following credentials:

            Email: andre@gmail.com

            Password: andre#777@

        Upon successful login, the API will return a Sanctum token which the frontend will store for future requests.

Testing the /api/contact/email Endpoint:

To retrieve sender data, make a GET request to the /api/contact/email endpoint with the following details:

    Email: stehr.petra@bauch.com

    Authorization: Use the token returned after login as a Bearer token.

Example API request with Postman:

    URL: http://localhost:8000/api/contact/email

    Method: GET

    Headers:

        Authorization: Bearer <your-sanctum-token>

        Email: stehr.petra@bauch.com

You can pass the email as a query parameter or in the headers depending on your backend setup. 7. Simulating Outlook Context

If you need to simulate Outlook context for login, you can set up a mock Outlook API or an OAuth provider that mimics Outlook authentication. The backend can be configured to accept tokens from such a provider.
Troubleshooting

    Docker Container Issues: If the containers don't start, try rebuilding the containers using:

docker build --no-cache -t laravel-react-app .
docker run -p 8000:8000 -p 3000:3000 laravel-react-app

API Errors: Check the Laravel logs for detailed error messages:

docker exec -it <container-name> tail -f storage/logs/laravel.log
