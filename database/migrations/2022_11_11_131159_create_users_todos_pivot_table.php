<?php

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //protected $connection = 'mysql2';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
     { // $this->getConnection()

        $defaultUser = User::where('id', '=', '1')->first();
        $allTodosQuery = Todo::all();
        
        Schema::create('todo_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('todo_id')->constrained('todos')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });



        foreach($allTodosQuery as $categoryQuery) {
            $defaultUser->todos()->attach($categoryQuery->id);
            $defaultUser->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todo_user');
    }
};
