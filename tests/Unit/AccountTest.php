<?php

declare(strict_types=1);

namespace TomasKulhanek\Tests\CzechDataBox\Unit;

use PHPUnit\Framework\TestCase;
use TomasKulhanek\CzechDataBox\Account;

class AccountTest extends TestCase
{
	use GeneratePkcs;

	private const TEST_PASS_PHRASE = 'isds';

	public function testCertificateLogin(): void
	{
		$account = new Account();
		$account->setLoginType(Account::LOGIN_CERT_LOGIN_NAME_PASSWORD);
		self::assertTrue($account->usingCertificate());
		$account->setLoginType(Account::LOGIN_HOSTED_SPIS);
		self::assertTrue($account->usingCertificate());
		$account->setLoginType(Account::LOGIN_SPIS_CERT);
		self::assertTrue($account->usingCertificate());
		$account->setLoginType(Account::LOGIN_NAME_PASSWORD);
		self::assertFalse($account->usingCertificate());
	}

	public function testPkcs12Certificate(): void
	{
		$passPhrase = self::TEST_PASS_PHRASE;
		$pkcsContent = $this->generateP12Certificate($passPhrase);

		$cert_array = [];
		openssl_pkcs12_read($pkcsContent, $cert_array, $passPhrase);

		$account = new Account();
		$account->setPkcs12Certificate($pkcsContent, $passPhrase);

		self::assertSame($account->getPrivateKeyPassPhrase(), $passPhrase);
		self::assertSame($account->getPrivateKey(), $cert_array['pkey']);
		self::assertSame($account->getPublicKey(), $cert_array['cert']);
	}
}
