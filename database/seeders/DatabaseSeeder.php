<?php

namespace Database\Seeders;

use App\Models\FamilyMember;
use App\Models\Report;
use App\Models\UnreportedIncident;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Report::factory(5)->create();
        UnreportedIncident::factory(2)->create();
        FamilyMember::factory(7)->create();
    }
}
