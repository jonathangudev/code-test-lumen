<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class MembersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMemberList()
    {
        $response = $this->get('/members');
        $response->assertResponseOk();
        $response->seeJsonStructure(
          [
              'error',
              'data' => [
                  '*' => [
                    'name', 'email', 'phone', 'subscription_name', 'subscription_price'
                  ]
              ]
        ]);
    }
}
