<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayerSeeder extends Seeder
{
    public function run(): void
    {
        $players = [
            [
                'name' => 'ЛеБрон Джеймс',
                'fullname' => 'ЛеБрон Реймон Джеймс',
                'position' => 'SF',
                'team' => 'LAL',
                'number' => 23,
                'img_url' => 'https://example.com/lebron.jpg',
                'height' => '206 см',
                'weight' => '113 кг',
                'age' => 39,
                'ppg' => 25.7,
                'rpg' => 7.3,
                'apg' => 8.3,
                'bio' => 'Легенда НБА, 4-кратный чемпион, часто считается одним из величайших баскетболистов в истории.',
            ],
            [
                'name' => 'Стефен Карри',
                'fullname' => 'Уордел Стефен Карри II',
                'position' => 'PG',
                'team' => 'GSW',
                'number' => 30,
                'img_url' => 'https://example.com/curry.jpg',
                'height' => '188 см',
                'weight' => '84 кг',
                'age' => 36,
                'ppg' => 26.4,
                'rpg' => 4.5,
                'apg' => 6.1,
                'bio' => 'Лучший трехочковый снайпер в истории НБА, 4-кратный чемпион, революционизировал игру.',
            ],
            [
                'name' => 'Лука Дончич',
                'fullname' => 'Лука Дончич',
                'position' => 'PG',
                'team' => 'DAL',
                'number' => 77,
                'img_url' => 'https://example.com/luka.jpg',
                'height' => '201 см',
                'weight' => '104 кг',
                'age' => 25,
                'ppg' => 28.4,
                'rpg' => 8.6,
                'apg' => 8.7,
                'bio' => 'Словенская суперзвезда, один из самых разносторонних игроков в НБА, MVP Европы.',
            ],
            [
                'name' => 'Яннис Адетокунбо',
                'fullname' => 'Яннис Адетокунбо',
                'position' => 'PF',
                'team' => 'MIL',
                'number' => 34,
                'img_url' => 'https://example.com/giannis.jpg',
                'height' => '211 см',
                'weight' => '110 кг',
                'age' => 29,
                'ppg' => 30.4,
                'rpg' => 11.5,
                'apg' => 6.5,
                'bio' => 'Греческий феномен, 2-кратный MVP, чемпион НБА 2021, известен своей невероятной атлетичностью.',
            ],
        ];

        foreach ($players as $playerData) {
            Player::create($playerData);
        }
    }
}