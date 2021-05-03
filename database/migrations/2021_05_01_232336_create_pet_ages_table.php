<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\PetAge;

class CreatePetAgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_ages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $ages = [
            'Baby',
            'Young',
            'Adult',
            'Senior'
        ];

        foreach($ages as $age){
            PetAge::create([
                'name' => $age
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pet_ages');
    }
}
