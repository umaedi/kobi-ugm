<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Universitas>
 */
class UniversitasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'           => mt_rand(1, 2),
            'nama_univ'         => $this->faker->sentence(mt_rand(2, 3)),
            'nama_kajur'        => $this->faker->name(),
            'nama_jurusan'      => $this->faker->company(),
            'email_kaprodi'             => $this->faker->email(),
            'alamat'            => $this->faker->address(),
            'provinsi'          => $this->faker->city(),
            'kabupaten'         => $this->faker->city(),
            'no_tlp'            => $this->faker->e164PhoneNumber(),
            'no_wa'            => $this->faker->e164PhoneNumber(),
            'kode_pos'          => $this->faker->postcode(),
            'no_anggota'        => $this->faker->postcode(),
            'bukti_pembayaran'  => $this->faker->postcode(),
            'verifikasi'        => mt_rand(1, 2),
        ];
    }
}
