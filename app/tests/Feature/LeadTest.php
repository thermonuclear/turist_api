<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeadTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->postJson('/add-lead', [
            'params' => [
                'name' => 'Смилик Анатолий Павлович',
                'phone' => '+79012223333',
                'email' => 'ivanov.sr@mail.ru',
                'source' => 'Facebook Leads',
                'fields' => [
                    [
                        'name' => 'Желаемая страна отдыха',
                        'values' => ['Египет', 'Тайланд', 'Турция', 'Мексика']
                    ],
                    [
                        'name' => 'Бюджет',
                        'values' => [250000]
                    ]
                ]
            ],
            'key' => 'x5pwceKAo7UJQQ3Y2tiUg9C6PpNf2cAxCJTNPIuYquWctv9Glh6cJVx45cAGbCAA',
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => 1,
        ]);
    }
}
