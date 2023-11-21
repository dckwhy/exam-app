<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = [
            [
                'name' => 'Amanda Jeni Kristina S.Pd',
                'subject' => 'Biologi',
                'graduate' => 'Universitas Tanjungpura Pontianak',
                'experience' => json_encode(array("SMA Muhammadiyah Sintang", "Bimbel DCW Sintang")),
            ],
            [
                'name' => 'Hesti Wulan Pebrianti S.Pd',
                'subject' => 'Fisika',
                'graduate' => 'IKIP PGRI Pontianak',
                'experience' => json_encode(array("Cendekia Khatulistiwa", "Primagama Sintang", "Primagama Melawi")),
            ],
            [
                'name' => ' Sri Rahmawati S.Pd',
                'subject' => 'Kimia',
                'graduate' => 'Universitas Tanjungpura Pontianak',
                'experience' => json_encode(array("GO Pontianak", "SMAS TBK", "Bimbel Yosi")),
            ],
            [
                'name' => ' Nurhasanah S.Pd',
                'subject' => 'Sosiologi',
                'graduate' => 'Universitas Tanjungpura Pontianak',
                'experience' => json_encode(array("SMA Muhammadiyah Sintang", "SMA PGRI Melawi", "Bimbel Yosi")),
            ],
            [
                'name' => ' Nina Rinarti S.Pd',
                'subject' => 'Geografi',
                'graduate' => 'IKIP PGRI Pontianak',
                'experience' => json_encode(array("SMA Santa Maria", "SMA Permata Kasih")),
            ],
            [
                'name' => 'Darmayati S.Pd',
                'subject' => 'Ekonomi',
                'graduate' => 'IKIP PGRI Pontianak',
                'experience' => json_encode(array("SMA Bina Kusuma")),
            ],
            [
                'name' => 'Nike S.Pd',
                'subject' => 'Bahasa Indonesia',
                'graduate' => 'Universitas Muhammadiyah Malang',
                'experience' => json_encode(array("Bimbel THREE", "Bimbel Thiya")),
            ],
            [
                'name' => 'Martina S.Pd',
                'subject' => 'Matematika',
                'graduate' => 'Universitas Tanjungpura Pontianak',
                'experience' => json_encode(array("KSM Pontianak", "Anak Cerdas Melawi")),
            ],
            [
                'name' => 'Iin Nurhayati S.Pd',
                'subject' => 'Matematika',
                'graduate' => 'Universitas Muhammadiyah Surakarta',
                'experience' => json_encode(array("SMA Bakti Setia")),
            ],
            [
                'name' => 'Sisilia Ica S.Pd',
                'subject' => 'Bahasa Inggris',
                'graduate' => 'Universitas Tanjungpura Pontianak',
                'experience' => json_encode(array("SMP 2 Nanga Pinoh", "Primagama Melaw")),
            ]
        ];
        Teacher::insert($teachers);
    }
}
