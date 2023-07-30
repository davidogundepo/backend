<?php

// tests/Controller/UserControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{

    private function getJwtTokenForUser(string $email, string $password): string
    {
        $client = static::createClient();

        // Send a POST request to the /api/login endpoint with valid user credentials
        $client->request('POST', '/api/login', [], [], ['CONTENT_TYPE' => 'application/json'], '{"email":"' . $email . '","password":"' . $password . '"}');

        // Get the JWT token from the response
        $responseData = json_decode($client->getResponse()->getContent(), true);
        return $responseData['token'];
    }

    
    public function testRegistration()
    {
        $client = static::createClient();

        // Send a POST request to the /api/register endpoint with valid user data
        $client->request('POST', '/api/register', [], [], ['CONTENT_TYPE' => 'application/json'], '{"name":"John Doe","email":"john@example.com","password":"secret"}');

        // Assert that the response is successful (HTTP status code 201)
        $this->assertEquals(201, $client->getResponse()->getStatusCode());

        // Assert that the response contains the success message
        $this->assertJsonStringEqualsJsonString('{"message":"User registration successful"}', $client->getResponse()->getContent());
    }

    public function testLogin()
    {
        $client = static::createClient();

        // Send a POST request to the /api/login endpoint with valid user credentials
        $client->request('POST', '/api/login', [], [], ['CONTENT_TYPE' => 'application/json'], '{"email":"john@example.com","password":"secret"}');

        // Assert that the response is successful (HTTP status code 200)
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // Assert that the response contains the JWT token
        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('token', $responseData);
    }

    public function testUserUpdate()
    {

        $jwtToken = $this->getJwtTokenForUser('john@example.com', 'secret');

        $client = static::createClient();

        // Send a PATCH request to the /api/user/update endpoint with updated user data
        $client->request('PATCH', '/api/user/update', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_Authorization' => 'Bearer ' . $jwtToken], '{"name":"Jane Doe","address":"456 Elm St"}');


        $client = static::createClient();

        // Authenticate as a user (assuming a registered user with valid JWT token)
        $jwtToken = 'YOUR_VALID_JWT_TOKEN'; // Replace with a valid JWT token for authentication

        // Send a PATCH request to the /api/user/update endpoint with updated user data
        $client->request('PATCH', '/api/user/update', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_Authorization' => 'Bearer ' . $jwtToken], '{"name":"Jane Doe","address":"456 Elm St"}');

        // Assert that the response is successful (HTTP status code 200)
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // Optionally, you can also assert the response message or check the updated data in the database.
    }

    public function testUserInfoRetrieval()
    {

        $jwtToken = $this->getJwtTokenForUser('john@example.com', 'secret');

        $client = static::createClient();

        // Send a GET request to the /api/user/info endpoint
        $client->request('GET', '/api/user/info', [], [], ['HTTP_Authorization' => 'Bearer ' . $jwtToken]);


        $client = static::createClient();

        // Authenticate as a user (assuming a registered user with valid JWT token)
        $jwtToken = 'YOUR_VALID_JWT_TOKEN'; // Replace with a valid JWT token for authentication

        // Send a GET request to the /api/user/info endpoint
        $client->request('GET', '/api/user/info', [], [], ['HTTP_Authorization' => 'Bearer ' . $jwtToken]);

        // Assert that the response is successful (HTTP status code 200)
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // Optionally, you can also assert the response data to check the user's information.
    }
}
