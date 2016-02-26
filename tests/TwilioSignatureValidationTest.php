<?php

class TwilioSignatureValidationTest extends TestCase
{
    /**
     * @var Services_Twilio_RequestValidator
     */
    private $validator;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();

        $this->validator = app()->make(Services_Twilio_RequestValidator::class);
    }

    /**
     * @test
     */
    public function post_with_signature_validation()
    {
        $inputs = [
            'From' => '+819012345678',
        ];

        $this->post('/api/signature/twilio/calling', $inputs, [
            'X-Twilio-Signature' => 'ynNqTQR2aI14J2zAEUz3pLZpvsw=',
        ]);
        $this->assertResponseStatus(200);
    }

    /**
     * @test
     */
    public function post_with_mismatch_signature()
    {
        $inputs = [
            'From' => '+819012345678',
        ];

        $this->post('/api/signature/twilio/calling', $inputs, [
            'X-Twilio-Signature' => 'YnNqTQR2aI14J2zAEUz3pLZpvsw=', // invalid
        ]);
        $this->assertResponseStatus(400);
    }
}
