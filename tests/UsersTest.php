<?php
// api/tests/UsersTest.php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\User;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class UsersTest extends ApiTestCase
{
    // This trait provided by AliceBundle will take care of refreshing the database content to a known state before each test
    use RefreshDatabaseTrait;

    public function testGetCollection(): void
    {
        // The client implements Symfony HttpClient's `HttpClientInterface`, and the response `ResponseInterface`
        $response = static::createClient()->request(
            'GET',
            '/api/users',
            [
                'auth_bearer' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NTgzMDk3MzUsImV4cCI6MTY1ODM5NjEzNSwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJlbWFpbCI6Im5pY29sYXNAb3JnYWFwcC5mciJ9.G7CDLTGTTqEpBDSyeYVpMWAQKhYCHeeKCtUf0dNFV1eaLpbz-bVZEhOXbOKW2ROgc3NuR7Wbv9BdabzhjON23fwL2KFUd2KU9PqvvsPSPkWkOXcDINdwldTGjJkI1ZGoBQcATizKrg-Q_TBP06Rt_Zm31DkWWN5dcygelmKzl9rodODF4sRdEQOD-vBu83WCfTA5fgrpjFpHSmBIcrb6DGIL_jt59eA8yfl5K9Wyu35KwaJH_0TlfI-M5u_ZfeERQPOkUy-zKRWpzi3zWD2Rw5MDq40QbIKKFtau-mBvXX06YTEtY5JlO5wjD67YFb1ve98-QpHvdGQ51aOJtHPftg',
                'json' => []
            ]
        );

        $this->assertResponseIsSuccessful();
        // Asserts that the returned content type is JSON-LD (the default)
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        // Asserts that the returned JSON is a superset of this one
        $this->assertJsonContains([
            '@context' => '/api/contexts/User',
            '@id' => '/api/users',
            '@type' => 'hydra:Collection',
            'hydra:totalItems' => 6
        ]);

        // Because test fixtures are automatically loaded between each test, you can assert on them
        $this->assertCount(6, $response->toArray()['hydra:member']);

        // Asserts that the returned JSON is validated by the JSON Schema generated for this resource by API Platform
        // This generated JSON Schema is also used in the OpenAPI spec!
        $this->assertMatchesResourceCollectionJsonSchema(User::class);
    }

    public function testCreateUser(): void
    {
        $response = static::createClient()->request('POST', '/api/users', ['auth_bearer' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NTgzMDk3MzUsImV4cCI6MTY1ODM5NjEzNSwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJlbWFpbCI6Im5pY29sYXNAb3JnYWFwcC5mciJ9.G7CDLTGTTqEpBDSyeYVpMWAQKhYCHeeKCtUf0dNFV1eaLpbz-bVZEhOXbOKW2ROgc3NuR7Wbv9BdabzhjON23fwL2KFUd2KU9PqvvsPSPkWkOXcDINdwldTGjJkI1ZGoBQcATizKrg-Q_TBP06Rt_Zm31DkWWN5dcygelmKzl9rodODF4sRdEQOD-vBu83WCfTA5fgrpjFpHSmBIcrb6DGIL_jt59eA8yfl5K9Wyu35KwaJH_0TlfI-M5u_ZfeERQPOkUy-zKRWpzi3zWD2Rw5MDq40QbIKKFtau-mBvXX06YTEtY5JlO5wjD67YFb1ve98-QpHvdGQ51aOJtHPftg', 'json' => [
            'email' => 'userTest@domain.fr',
            'lastname' => 'lastnameTest',
            'firstname' => 'firstnameTest',
            'plainPassword' => 'test123',
            'username' => 'usernameTest'
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/User',
            '@type' => 'User',
            'email' => 'userTest@domain.fr',
            //'roles' => ["ROLE_USER"],
            'lastname' => 'lastnameTest',
            'firstname' => 'firstnameTest',
            //'password' => '$2y$13$CRItRYiXyfuYcM7b1ChsvuebbSvUZGxQm3PBfgioA41stItTEa/Q6',
            'username' => 'usernameTest'
        ]);
        $this->assertMatchesRegularExpression('~^/api/users/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(User::class);
    }

    //     public function testCreateInvalidUser(): void
    //     {
    //         static::createClient()->request('POST', '/users', ['json' => [
    //             'isbn' => 'invalid',
    //         ]]);

    //         $this->assertResponseStatusCodeSame(422);
    //         $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

    //         $this->assertJsonContains([
    //             '@context' => '/contexts/ConstraintViolationList',
    //             '@type' => 'ConstraintViolationList',
    //             'hydra:title' => 'An error occurred',
    //             'hydra:description' => 'isbn: This value is neither a valid ISBN-10 nor a valid ISBN-13.
    // title: This value should not be blank.
    // description: This value should not be blank.
    // author: This value should not be blank.
    // publicationDate: This value should not be null.',
    //         ]);
    //     }

    //     public function testUpdateUser(): void
    //     {
    //         $client = static::createClient();
    //         // findIriBy allows to retrieve the IRI of an item by searching for some of its properties.
    //         // ISBN 9786644879585 has been generated by Alice when loading test fixtures.
    //         // Because Alice use a seeded pseudo-random number generator, we're sure that this ISBN will always be generated.
    //         $iri = $this->findIriBy(User::class, ['isbn' => '9781344037075']);

    //         $client->request('PUT', $iri, ['json' => [
    //             'title' => 'updated title',
    //         ]]);

    //         $this->assertResponseIsSuccessful();
    //         $this->assertJsonContains([
    //             '@id' => $iri,
    //             'isbn' => '9781344037075',
    //             'title' => 'updated title',
    //         ]);
    //     }

    //     public function testDeleteUser(): void
    //     {
    //         $client = static::createClient();
    //         $iri = $this->findIriBy(User::class, ['isbn' => '9781344037075']);

    //         $client->request('DELETE', $iri);

    //         $this->assertResponseStatusCodeSame(204);
    //         $this->assertNull(
    //             // Through the container, you can access all your services from the tests, including the ORM, the mailer, remote API clients...
    //             static::getContainer()->get('doctrine')->getRepository(User::class)->findOneBy(['isbn' => '9781344037075'])
    //         );
    //     }

    //     public function testLogin(): void
    //     {
    //         $response = static::createClient()->request('POST', '/login', ['json' => [
    //             'email' => 'admin@example.com',
    //             'password' => 'admin',
    //         ]]);

    //         $this->assertResponseIsSuccessful();
    //     }
}
