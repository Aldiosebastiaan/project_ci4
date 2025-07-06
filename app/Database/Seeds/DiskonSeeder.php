<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiskonSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $baseDate = strtotime('2025-06-25');
        $createdAt = date('Y-m-d H:i:s', $baseDate);

        for ($i = 0; $i < 10; $i++) {
            $tanggal = date('Y-m-d', strtotime("+$i days", $baseDate));
            $nominal = 100000 + ($i * 10000); // contoh variasi nominal

            $data[] = [
                'tanggal'    => $tanggal,
                'nominal'    => $nominal,
                'created_at' => $createdAt,
                'updated_at' => null,
            ];
        }

        $this->db->table('diskon')->insertBatch($data);
    }
}
