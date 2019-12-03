<?php

namespace App\Tests\Controller;

use App\Controller\LoginController;

use PHPUnit\Framework\TestCase;

class LoginControllerTest extends TestCase {

	/** @test */
	public function testeStoreSessionData()
	{
		return $this->assertEquals(true, saveSession('a', 'b'));
	}
}