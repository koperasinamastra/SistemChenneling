<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Debitur>
 */
class DebiturFactory extends Factory
{
    /**
     * Define the model"s default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "nama_debitur"=> $this->faker->name(),
            "noktp"=>$this->faker->randomNumber(9, true),
            "alamat"=>$this->faker->address(),
            "tlp"=>$this->faker->e164PhoneNumber(),
            "email"=> $this->faker->unique()->safeEmail(),
            "foto_ktp"=>$this->faker->imageUrl(640, 480, "animals", true),
            "foto_kk" =>$this->faker->imageUrl(640, 480, "animals", true),
            "foto_pasangan" =>$this->faker->imageUrl(640, 480, "animals", true),
            "tempat_lahir" =>$this->faker->city(),
            "tgl_lahir" => $this->faker->dateTime(),
            "ibu_kandung"=>$this->faker->name(),
            "nama_pasangan"=>$this->faker->name(),
            "tgl_lahir_pasangan"=>$this->faker->date(),
            "pendidikan"=>$this->faker->opera(),
            "status_kawin"=>$this->faker->numberBetween(1, true),
            "jumlah_tunjangan"=>$this->faker->numberBetween(1, true),
            "no_npwp" =>$this->faker->randomNumber(9, true),
            "alamat_skrng" =>$this->faker->address(),
            "status_tinggal" =>$this->faker->numberBetween(1, true),
            "Jenis_pekerjaan" =>$this->faker->opera(),
            "nama_perusahaan"=>$this->faker->chrome(),
            "tlp_perusahaan" =>$this->faker->phoneNumber(),
            "lama_bekerja"=>$this->faker->randomDigit(),
            "penghasilan_bersih"=>$this->faker->randomDigit(5, true)
        ];
    }
}
