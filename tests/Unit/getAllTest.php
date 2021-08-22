<?php

namespace Tests\Unit;

use Tests\TestCase;

class getAllTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/api/users');
        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $response->assertSimilarJson([
            "data" => [
                [
                    "user_name" => "samhit",
                    "mobile_number"=> "1111111111"
                ],
                [
                    "user_name" => "samhit1",
                    "mobile_number" => "1121111111"
                ],
                [
                    "user_name" => "samhit11",
                    "mobile_number" => "1122111111"
                ]
            ],
            "description" => "success"
        ]);
    }
}
