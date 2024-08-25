<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\DataFixtures\UserRoleFixture;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class GetUserPermissionTest extends ApiTestCase
{
    protected function setUp(): void
    {
        self::bootKernel();

        $application = new Application(self::$kernel);
        $application->setAutoExit(false);

        // Очистка и загрузка фикстур
        $application->run(new ArrayInput([
            'command' => 'doctrine:fixtures:load',
            '--no-interaction' => true,
            '--env' => 'test',
            '--purge-with-truncate' => true,  // Используем TRUNCATE для очистки
        ]));
    }
    public function testGettingUserPermission(): void
    {
        $client = static::createClient();
        $token = $this->getUserToken($client);
        $client->request('POST', 'https://permission.localhost/get-user-permissions', [

            'headers' => [
                'Content-Type' => 'application/ld+json',
                'Authorization' => sprintf('Bearer %s', $token)
            ],
        ]);

        $this->assertResponseStatusCodeSame(200);

        $this->assertJsonContains([
            'test permission' => 'test role'
        ]);
    }

    private function getUserToken($client)
    {
        $user = new class implements UserInterface, PasswordAuthenticatedUserInterface {
            public function getRoles(): array
            {
                return ['ROLE_USER'];
            }

            public function eraseCredentials(): void
            {
                // TODO: Implement eraseCredentials() method.
            }

            public function getUserIdentifier(): string
            {
                return 'id';
            }

            public function getPassword(): ?string
            {
                return '123123';
            }

        };
        $jWTTokenManager = $client->getContainer()->get(JWTTokenManagerInterface::class);
        return $jWTTokenManager->createFromPayload($user, ['id' => UserRoleFixture::USER_ID]);
    }
}
