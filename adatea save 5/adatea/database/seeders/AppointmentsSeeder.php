<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AppointmentsSeeder extends Seeder
{
    /**
     * Exécutez les seeds de la base de données.
     *
     * @return void
     */
    public function run()
    {
        // Récupérer les IDs existants
        $clientIds = DB::table('clients')->pluck('client_id');
        $prospectIds = DB::table('prospects')->pluck('prospect_id');
        $salespersonIds = DB::table('employers')->pluck('employer_id');
    
        // Vérifier si les IDs ne sont pas vides
        if ($clientIds->isEmpty() || $prospectIds->isEmpty() || $salespersonIds->isEmpty()) {
            // Vous pourriez vouloir écrire des logs ici ou créer des données de référence
            return;
        }

        // Définir les statuts possibles
        $statuses = ['Planned', 'Realized', 'Canceled'];
    
        for ($i = 0; $i < 10; $i++) {
            $clientId = $clientIds->random();
            $prospectId = $prospectIds->random();
            $salespersonId = $salespersonIds->random();

            // Sélectionner un statut aléatoire
            $status = $statuses[array_rand($statuses)];
    
            DB::table('appointments')->insert([
                'client_id' => $clientId, 
                'prospect_id' => $prospectId, 
                'salesperson_id' => $salespersonId, 
                'date_time' => Carbon::now()->addDays(rand(0, 30)), 
                'location' => Str::random(10), 
                'status' => $status,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
