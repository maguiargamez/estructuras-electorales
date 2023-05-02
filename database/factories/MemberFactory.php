<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $curp= $this->faker->regexify('[A-Za-z0-9]{18}');
        $school_grade_id=1;
        $activity_id= 1;
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'sex' => $this->faker->boolean,
            'birth_date' => $this->faker->date(),
            //'electoral_key' => $this->ean13(),
            'electoral_key' => $curp,
            'electoral_key_validity' => '2023',
            'curp' => $curp,
            'section'=> 100,
            'section_type' => 2, 
            'address' => $this->faker->address, 
            'neighborhood' => $this->faker->streetName, 
            'zip_code' => $this->faker->postcode, 
            'neighborhood' => $this->faker->streetName, 
            'membership' => $this->faker->boolean,
            'political_organization' => $this->faker->boolean,
            'school_grade_id' => $school_grade_id,
            'activity_id' => $activity_id,
            'political_organization' => $this->faker->boolean,


        ];
    }
}
