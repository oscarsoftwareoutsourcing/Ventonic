<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\ContactType;

class ContactTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $types = [
            'Cliente',
            'Cliente potencial',
            'Colaborador',
            'Proveedor',
            'Cliente Perdido',
        ];

        DB::transaction(function () use ($types) {
            foreach ($types as $type) {
                ContactType::updateOrCreate(['name' => $type]);
            }
        });
    }
}
