<?php

class SecureTwilioCallingTest extends TestCase
{
    /**
     * @test
     */
    public function post_401()
    {
        $this->post('/api/secure/twilio/calling', []);
        $this->assertResponseStatus(401);
    }

    /**
     * @test
     */
    public function post_with_user_and_password()
    {
        $inputs = [
            'From' => '+819012345678',
        ];

        $this->post('/api/secure/twilio/calling', $inputs, [
            'PHP_AUTH_USER' => 'user',
            'PHP_AUTH_PW' => 'pass'
        ]);
        $this->assertResponseStatus(200);
    }
}
