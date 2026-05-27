<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NumberGuessControllerTest extends WebTestCase
{
	protected function setUp(): void
	{
		parent::setUp();

		static::bootKernel();
		$entityManager = static::getContainer()->get('doctrine')->getManager();

		$metadata = $entityManager->getMetadataFactory()->getAllMetadata();
		if ($metadata !== []) {
			$schemaTool = new SchemaTool($entityManager);
			$schemaTool->dropSchema($metadata);
			$schemaTool->createSchema($metadata);
		}

		static::ensureKernelShutdown();
	}

	public function testIndexRedirectsToNewGameWithBasicAuth(): void
	{
		$client = static::createClient();
		$client->setServerParameter('PHP_AUTH_USER', 'testing');
		$client->setServerParameter('PHP_AUTH_PW', 'day');
		$client->request('GET', '/');

		$this->assertResponseStatusCodeSame(302);

		$location = $client->getResponse()->headers->get('Location');
		$this->assertNotNull($location);
		$this->assertStringContainsString('/game/', $location);
	}
}

