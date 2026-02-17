<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/roles_data.csv');

        if (!file_exists($path)) {
            dd("CSV tidak ditemukan: " . $path);
        }

        $file = fopen($path, 'r');
        $isHeader = true;

        while (($row = fgetcsv($file)) !== false) {

            // skip header
            if ($isHeader) {
                $isHeader = false;
                continue;
            }

            DB::table('roles')->insert([
                'role_name'           => $row[0],
                'skills'              => $row[1],
                'avg_salary_idr'      => $row[2] ?? null,
                'vacancy_count'       => $row[3] ?? null,
                'experience_required' => $row[4] ?? null,
                'source'              => $row[5] ?? null,
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);}
        fclose($file);
    }}
