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

        $this->post('/api/twilio/calling-with-signature', $inputs, [
            'X-Twilio-Signature' => '+sndfa0paQ+m2P0PZ4U/2lnLkHw=',
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

        $this->post('/api/twilio/calling-with-signature', $inputs, [
            'X-Twilio-Signature' => '+Sndfa0paQ+m2P0PZ4U/2lnLkHw=', // invalid
        ]);
        $this->assertResponseStatus(400);
    }
}
