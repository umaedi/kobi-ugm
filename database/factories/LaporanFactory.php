<?php

namespace Database\Factories;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laporan>
 */
class LaporanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_kegiatan'           => $this->faker->sentence(mt_rand(2, 5)),
            'slug'            => $this->faker->slug(),
            'file_laporan'    => $this->faker->imageUrl(),
            'tgl_kegiatan'    => Carbon::now(),
        ];
    }
}
