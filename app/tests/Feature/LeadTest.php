<?php

namespace Tests\Feature;

use Tests\TestCase;

class LeadTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddLead()
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
            'key' => env("API_KEY_TEST"),
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => 1,
        ]);
    }
}
