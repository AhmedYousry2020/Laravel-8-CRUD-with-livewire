<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Continent;
class ContinentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       $continents = [ "Asia", "Africa", "North America", "South America", "Antarctica", "Europe", "Australia"]; 
       for ( $i=1; $i < sizeof($continents); $i++) {
        Continent::create([
            "continent_name"=>$continents[$i]
        ]);

        }
       
    }           
}
