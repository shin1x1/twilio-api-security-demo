<?php

class TwilioCallingTest extends TestCase
{
    /**
     * @test
     */
    public function post_()
    {
        $inputs = [
            'From' => '+819012345678',
        ];

        $expected = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Say voice="woman" language="ja-JP">田中さんのポイントは 100 ポイントです。</Say>
</Response>
EOT;

        $this->post('/api/twilio/calling', $inputs);
        $this->assertResponseOk();

        $this->assertSame($expected, $this->response->getContent());
    }

    /**
     * @test
     */
    public function post_with_invalid_telNo()
    {
        $inputs = [
            'From' => '+819012345678a',
        ];

        $this->post('/api/twilio/calling', $inputs)
            ->assertResponseStatus(302);
    }

    /**
     * @test
     */
    public function post_with_no_telNo_exists()
    {
        $inputs = [
            'From' => '+819011111111',
        ];

        $expected = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Say voice="woman" language="ja-JP">会員ではありません。</Say>
</Response>
EOT;

        $this->post('/api/twilio/calling', $inputs);
        $this->assertResponseOk();

        $this->assertSame($expected, $this->response->getContent());
    }
}
