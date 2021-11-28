<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        주문번호	12	필수	중복이 불가능한 임의의 영문 대문자, 숫자 조합
        제품명	100	필수	emoji 를 포함한 모든 문자
        결제일시	Datetime	필수	Timezone 을 고려한 시간 정보
        return [
            //
        ];
    }
}
