<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TouristTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $response = $this->postJson('/add-tourist', [
            'params' => [
                'name' => 'Сидоренко Иван Николаевич',
                'name_lat' => 'SIDORENKO IVAN',
                'gender' => 'm',
                'address' => 'г. Екатеринбург, ул. Малышева 51',
                'tel' => '+79024567891',
                'email' => 'sidorenko.in@mail.ru',
                'passport_series' => '65',
                'passport_number' => '123456',
                'passport_who' => 'FMS 67',
                'passport_when' => '2011-05-11',
                'passport_till' => '2021-05-11',
                'passport_series_rus' => '64 02',
                'passport_number_rus' => '022233',
                'passport_who_rus' => 'ОВД 66',
                'passport_when_rus' => '2006-10-15',
                'dr' => '1988-12-10',
                'receive_sms' => 1,
                'receive_email' => 1,
                'manager_id' => 1,
                'office_id' => 1,
                'groups' => [],
                'contacts' => [
                    1 => [335697421],
                    5 => ['help.moidokumenti.ru']
                ],
                'vk' => json_encode([
                    [
                        'id' => 335697421,
                        'name' => 'Антонина Тимофеева',
                        'photo' => 'https://pp.vk.me/c630917/v630917421/2285/tqU5S8WpWqM.jpg'
                    ]
                ])
            ],
            'key' => env("API_KEY_TEST"),
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => 1,
        ]);
    }

    public function testUpdate()
    {
        $response = $this->postJson('/edit-tourist', [
            'params' => [
                'id' => 1,
                'name' => 'Сидоренко Иван Николаевич',
                'name_lat' => 'SIDORENKO IVAN',
                'gender' => 'm',
                'address' => 'г. Екатеринбург, ул. Малышева 11',
                'tel' => '+79024567891',
                'email' => 'sidorenko.in@mail.ru',
                'passport_series' => '65',
                'passport_number' => '123456',
                'passport_who' => 'FMS 67',
                'passport_when' => '2011-05-11',
                'passport_till' => '2021-05-11',
                'passport_series_rus' => '64 02',
                'passport_number_rus' => '022233',
                'passport_who_rus' => 'ОВД 66',
                'passport_when_rus' => '2006-10-15',
                'dr' => '1988-12-10',
                'receive_sms' => 1,
                'receive_email' => 1,
                'manager_id' => 1,
                'office_id' => 1,
                'contacts' => [
                    1 => [335697421],
                    5 => ['help.moidokumenti.ru']
                ],
                'vk' => json_encode([
                    [
                        'id' => 335697421,
                        'name' => 'Антонина Тимофеева',
                        'photo' => 'https://pp.vk.me/c630917/v630917421/2285/tqU5S8WpWqM.jpg'
                    ]
                ])
            ],
            'key' => env("API_KEY_TEST"),
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => 1,
        ]);
    }

    public function testShow()
    {
        $response = $this->postJson('/get-tourist-list', [
            'params' => [
                'offset' => 0,
                'count' => 10,
                'fields' => [
                    'id',
                    'name',
                    'name_lat',
                    'address',
                    'tel',
                    'dr',
                    'passport_series',
                    'passport_number',
                    'passport_who',
                    'passport_when',
                    'passport_till',
                    'gender',
                    'email',
                    'passport_series_rus',
                    'passport_number_rus',
                    'passport_who_rus',
                    'passport_when_rus',
                    'receive_sms',
                    'receive_email',
                    'manager_id',
                    'office_id',
                    // эти поля, по-видимому, должны храниться в иной таблице(она в этом примере не реализована)
                    // 'manager_name',
                    // 'office_name',
                    // 'comments',
                ]
            ],
            'key' => env("API_KEY_TEST"),
        ]);

        $response->assertStatus(200)->assertJson([
            ['id' => 1],
        ]);
    }

    public function testShowName()
    {
        $response = $this->postJson('/get-tourist-list-by-name', [
            'params' => [
                'offset' => 0,
                'count' => 10,
                'search' => 'Сидоренко'
            ],
            'key' => env("API_KEY_TEST"),
        ]);

        $response->assertStatus(200)->assertJson([
            "Сидоренко Иван Николаевич",
        ]);
    }

    public function testDestroy()
    {
        $response = $this->postJson('/delete-tourist', [
            'params' => [
                'id' => 24
            ],
            'key' => env("API_KEY_TEST"),
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => 1,
        ]);
    }
}
