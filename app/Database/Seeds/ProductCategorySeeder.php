<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
            'nama' => 'Macbook',
            'model' => 'Laptop',
            'deskripsi' => 'Macbook worth it di 2025!',
            'created_at' => date("Y-m-d H:i:s"),
            ],
            [
            'nama' => 'Asus',
            'model' => 'Laptop',
            'deskripsi' => 'Asus punya banyak versi lohh!',
            'created_at' => date("Y-m-d H:i:s"),
            ],
            [
            'nama' => 'Lenovo',
            'model' => 'Laptop',
            'deskripsi' => 'Lenovo juga punyaa nihh!',
            'created_at' => date("Y-m-d H:i:s"),
            ],
        ];
        foreach ($data as $item) {
            $this->db->table('product_category')->insert($item);
        }
    }
}
