<?php

namespace Database\Seeders\Important;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    private array $subjects;
    public function __construct()
    {
        $this->subjects = [
            'Россия' => [
                'Адыгея Республика' => [
                    'Адыгейск',
                    'Майкоп'
                ],
                'Башкортостан Республика' => [
                    'Агидель',
                    'Баймак',
                    'Белебей',
                    'Белорецк',
                    'Бирск',
                    'Благовещенск',
                    'Давлеканово',
                    'Дюртюли',
                    'Ишимбай',
                    'Кумертау',
                    'Межгорье',
                    'Мелеуз',
                    'Нефтекамск',
                    'Октябрьский',
                    'Салават',
                    'Сибай',
                    'Стерлитамак',
                    'Туймазы',
                    'Уфа',
                    'Учалы',
                    'Янаул'
                ],
                'Бурятия Республика' => [
                    'Бабушкин',
                    'Гусиноозерск',
                    'Закаменск',
                    'Кяхта',
                    'Северобайкальск',
                    'Улан-Удэ'
                ],
                'Алтай Республика' => [
                    'Горно-Алтайск'
                ],
                'Дагестан Республика' => [
                    'Буйнакск',
                    'Дагестанские Огни',
                    'Дербент',
                    'Избербаш',
                    'Каспийск',
                    'Кизилюрт',
                    'Кизляр',
                    'Махачкала',
                    'Хасавюрт',
                    'Южно-Сухокумск'
                ],
                'Ингушетия Республика' => [
                    'Карабулак',
                    'Магас',
                    'Малгобек',
                    'Назрань'
                ],
                'Кабардино-Балкарская Республика' => [
                    'Баксан',
                    'Майский',
                    'Нальчик',
                    'Нарткала',
                    'Прохладный',
                    'Терек',
                    'Тырныауз',
                    'Чегем'
                ],
                'Калмыкия Республика' => [
                    'Городовиковск',
                    'Лагань',
                    'Элиста'
                ],
                'Карачаево-Черкесская Республика' => [
                    'Карачаевск',
                    'Теберда',
                    'Усть-Джегута',
                    'Черкесск'
                ],
                'Карелия Республика' => [
                    'Беломорск',
                    'Кемь',
                    'Кондопога',
                    'Костомукша',
                    'Лахденпохья',
                    'Медвежьегорск',
                    'Олонец',
                    'Петрозаводск',
                    'Питкяранта',
                    'Пудож',
                    'Сегежа',
                    'Сортавала',
                    'Суоярви'
                ],
                'Коми Республика' => [
                    'Воркута',
                    'Вуктыл',
                    'Емва',
                    'Инта',
                    'Микунь',
                    'Печора',
                    'Сосногорск',
                    'Сыктывкар',
                    'Усинск',
                    'Ухта'
                ],
                'Марий Эл Республика' => [
                    'Волжск',
                    'Звенигово',
                    'Йошкар-Ола',
                    'Козьмодемьянск'
                ],
                'Мордовия Республика' => [
                    'Ардатов',
                    'Инсар',
                    'Ковылкино',
                    'Краснослободск',
                    'Рузаевка',
                    'Саранск',
                    'Темников'
                ],
                'Саха /Якутия/ Республика' => [
                    'Алдан',
                    'Верхоянск',
                    'Вилюйск',
                    'Ленск',
                    'Мирный',
                    'Нерюнгри',
                    'Нюрба',
                    'Олекминск',
                    'Покровск',
                    'Среднеколымск',
                    'Томмот',
                    'Удачный',
                    'Якутск'
                ],
                'Северная Осетия - Алания Республика' => [
                    'Алагир',
                    'Ардон',
                    'Беслан',
                    'Владикавказ',
                    'Дигора',
                    'Моздок'
                ],
                'Татарстан Республика' => [
                    'Агрыз',
                    'Азнакаево',
                    'Альметьевск',
                    'Арск',
                    'Бавлы',
                    'Болгар',
                    'Бугульма',
                    'Буинск',
                    'Елабуга',
                    'Заинск',
                    'Зеленодольск',
                    'Казань',
                    'Лаишево',
                    'Лениногорск',
                    'Мамадыш',
                    'Менделеевск',
                    'Мензелинск',
                    'Набережные Челны',
                    'Нижнекамск',
                    'Нурлат',
                    'Тетюши',
                    'Чистополь'
                ],
                'Тыва Республика' => [
                    'Ак-Довурак',
                    'Кызыл',
                    'Туран',
                    'Чадан',
                    'Шагонар'
                ],
                'Удмуртская Республика' => [
                    'Воткинск',
                    'Глазов',
                    'Ижевск',
                    'Камбарка',
                    'Можга',
                    'Сарапул'
                ],
                'Хакасия Республика' => [
                    'Абаза',
                    'Абакан',
                    'Саяногорск',
                    'Сорск',
                    'Черногорск'
                ],
                'Чеченская Республика' => [
                    'Аргун',
                    'Грозный',
                    'Гудермес',
                    'Урус-Мартан',
                    'Шали'
                ],
            ]
        ];
    }

    public function run(): void
    {
        foreach ($this->subjects as $country => $regions) {
            $created_country = Country::factory([
                'name' => $country
            ])->create();
            foreach($regions as $region => $cities) {
                $created_region = Region::factory([
                    'name' => $region,
                    'country_id' => $created_country->id
                ])->create();
                foreach ($cities as $city) {
                    City::factory([
                        'name' => $city,
                        'region_id' => $created_region->id
                    ])->create();
                }
            }
        }
    }
}
