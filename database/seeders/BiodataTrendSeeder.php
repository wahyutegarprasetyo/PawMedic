<?php

namespace Database\Seeders;

use App\Models\Biodata;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BiodataTrendSeeder extends Seeder
{
    /**
     * Seed dummy diagnosis results so disease trend charts have data.
     */
    public function run(): void
    {
        Biodata::query()
            ->where('no_telepon', 'like', '08DUMMY%')
            ->delete();

        $diseases = [
            [
                'name' => 'Scabies',
                'category' => 'Parasit',
                'symptoms' => ['Gatal hebat', 'Kerak pada telinga', 'Bulu rontok', 'Kulit kemerahan'],
                'weight' => 5,
            ],
            [
                'name' => 'Feline calicivirus',
                'category' => 'Virus',
                'symptoms' => ['Bersin', 'Sariawan', 'Air liur berlebih', 'Nafsu makan menurun'],
                'weight' => 4,
            ],
            [
                'name' => 'Jamur/Ringworm',
                'category' => 'Parasit',
                'symptoms' => ['Bulu rontok melingkar', 'Kulit bersisik', 'Gatal', 'Kerak pada kulit'],
                'weight' => 4,
            ],
            [
                'name' => 'Cacingan',
                'category' => 'Parasit',
                'symptoms' => ['Perut membesar', 'Berat badan turun', 'Muntah', 'Diare'],
                'weight' => 3,
            ],
            [
                'name' => 'FLUTD (Feline Lower Urinary Tract Diseases)',
                'category' => 'Virus / Lingkungan',
                'symptoms' => ['Sulit buang air kecil', 'Sering ke litter box', 'Urin berdarah', 'Nyeri saat pipis'],
                'weight' => 3,
            ],
            [
                'name' => 'Diare Non Spesifik',
                'category' => 'Virus / Parasit',
                'symptoms' => ['Diare', 'Lemas', 'Nafsu makan menurun', 'Dehidrasi ringan'],
                'weight' => 2,
            ],
            [
                'name' => 'Earmite',
                'category' => 'Parasit',
                'symptoms' => ['Telinga kotor', 'Sering menggaruk telinga', 'Bau telinga', 'Kepala sering digelengkan'],
                'weight' => 2,
            ],
        ];

        $areas = [
            'Sumbersari',
            'Kaliwates',
            'Patrang',
            'Ajung',
            'Rambipuji',
            'Ambulu',
            'Puger',
            'Wuluhan',
            'Arjasa',
            'Jenggawah',
        ];

        $cats = [
            ['owner' => 'Alya Pratama', 'cat' => 'Milo', 'gender' => 'Jantan', 'breed' => 'Domestik'],
            ['owner' => 'Bima Santoso', 'cat' => 'Luna', 'gender' => 'Betina', 'breed' => 'Persia'],
            ['owner' => 'Citra Dewi', 'cat' => 'Oyen', 'gender' => 'Jantan', 'breed' => 'Domestik'],
            ['owner' => 'Dani Kurniawan', 'cat' => 'Mochi', 'gender' => 'Betina', 'breed' => 'Anggora'],
            ['owner' => 'Eka Lestari', 'cat' => 'Nala', 'gender' => 'Betina', 'breed' => 'Mixdom'],
            ['owner' => 'Farhan Hakim', 'cat' => 'Simba', 'gender' => 'Jantan', 'breed' => 'Persia Medium'],
            ['owner' => 'Gita Maharani', 'cat' => 'Coco', 'gender' => 'Betina', 'breed' => 'Domestik'],
            ['owner' => 'Hendra Wijaya', 'cat' => 'Leo', 'gender' => 'Jantan', 'breed' => 'Maine Coon Mix'],
            ['owner' => 'Intan Permata', 'cat' => 'Mimi', 'gender' => 'Betina', 'breed' => 'Domestik'],
            ['owner' => 'Joko Saputra', 'cat' => 'Tom', 'gender' => 'Jantan', 'breed' => 'British Shorthair Mix'],
        ];

        $weightedDiseases = [];
        foreach ($diseases as $disease) {
            for ($i = 0; $i < $disease['weight']; $i++) {
                $weightedDiseases[] = $disease;
            }
        }

        $rows = [];
        $today = Carbon::today();
        $rowNumber = 1;

        for ($dayOffset = 0; $dayOffset < 30; $dayOffset++) {
            $casesForDay = 1 + ($dayOffset % 4);

            if (in_array($dayOffset, [0, 1, 2, 6, 13, 20], true)) {
                $casesForDay++;
            }

            for ($case = 0; $case < $casesForDay; $case++) {
                $cat = $cats[($rowNumber + $case) % count($cats)];
                $disease = $weightedDiseases[($dayOffset + $case + $rowNumber) % count($weightedDiseases)];
                $createdAt = $today
                    ->copy()
                    ->subDays($dayOffset)
                    ->setTime(8 + (($case * 3) % 10), (17 + $rowNumber) % 60, 0);

                $rows[] = [
                    'nama_pemilik' => $cat['owner'] . ' ' . str_pad((string) $rowNumber, 2, '0', STR_PAD_LEFT),
                    'nama_kucing' => $cat['cat'],
                    'umur_kucing' => 6 + (($rowNumber * 3) % 72),
                    'jenis_kelamin' => $cat['gender'],
                    'berat_badan' => 2.4 + (($rowNumber % 18) / 10),
                    'ras_kucing' => $cat['breed'],
                    'alamat' => $areas[($dayOffset + $case) % count($areas)],
                    'no_telepon' => '08DUMMY' . str_pad((string) $rowNumber, 5, '0', STR_PAD_LEFT),
                    'hasil_diagnosis' => $disease['name'],
                    'jenis' => $disease['category'],
                    'gejala_dipilih' => json_encode($disease['symptoms'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ];

                $rowNumber++;
            }
        }

        Biodata::query()->insert($rows);
    }
}
