<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\SchoolGrade;
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
        $curp= $this->faker->regexify('[A-Z0-9]{18}');
        $sex= $this->faker->boolean;
        ($sex==1) ? $firstname= $this->faker->firstNameMale : $firstname= $this->faker->firstNameFemale;
        $hasSocialNetworks= $this->faker->boolean;

        $facebook= null;
        $instagram= null;
        $twitter= null;
        $tiktok= null;
        
        if($hasSocialNetworks){
            $facebook= 'www.facebook.com/'.strtolower($firstname);
            $instagram= 'www.instagram.com/'.strtolower($firstname);
            $twitter= 'www.twitter.com/'.strtolower($firstname);
            $tiktok= 'www.tiktok.com/'.strtolower($firstname);
        }

        return [
            'position_id' => 2,
            'firstname' => $firstname,
            'lastname' => $this->faker->lastName.' '.$this->faker->lastName,
            'sex' => $sex,
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
            'school_grade_id' => SchoolGrade::all()->random()->id,
            'activity_id' => Activity::all()->random()->id,
            'mobile_phone' => $this->faker->phoneNumber,
            'house_phone' => $this->faker->phoneNumber,
            'email' => mt_rand(1, 10).$this->faker->safeEmail,
            'has_social_networks' => $hasSocialNetworks,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'twitter' => $twitter,
            'tiktok' => $tiktok,
            'is_validated' => $this->faker->boolean,
            'was_supported' => $this->faker->boolean,

        ];
    }
}
