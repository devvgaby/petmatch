<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $now = Carbon::now();

        //Apenas para povoamento da tabela e para testes
        // Perfis
        DB::table('perfis')->insert([
            ['id' => 1, 'nome' => 'administrador', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'nome' => 'tutor', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // Usuário Administrador
        DB::table('usuarios')->insert([
            [
                'id' => 1,
                'nome' => 'Administrador PetMatch',
                'email' => 'admin@petmatch.com',
                'password' => Hash::make('password123'),
                'telefone' => '(11) 99999-0000',
                'endereco' => 'Rua Central, 100',
                'cep' => '01234-567',
                'latitude' => -23.550520,
                'longitude' => -46.633308,
                'perfil_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);

        // Usuário Tutor
        DB::table('usuarios')->insert([
            [
                'id' => 2,
                'nome' => 'Tutor Exemplo',
                'email' => 'tutor@petmatch.com',
                'password' => Hash::make('password123'),
                'telefone' => '(11) 98888-8888',
                'endereco' => 'Avenida dos Pets, 456',
                'cep' => '98765-432',
                'latitude' => -23.551000,
                'longitude' => -46.634000,
                'perfil_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
