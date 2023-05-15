<?php

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $allUsers = User::has('todos')->get();
        // if (Schema::hasColumn('todos', 'user_id')) {
        //     Schema::table('todos', function (Blueprint $table) {
        //         $table->dropColumn('user_id');
        //     });
        // }

        Schema::table('todos', function (Blueprint $table) {
            $table->after('id', function ($table) {
                $table->integer('user_id');
            });
        });

        $allTodos = Todo::with('users')->get();
        foreach($allTodos as $todo) {
            $user = $todo->users;
            DB::table('todos')
            ->where('id', $todo->id)
            ->update(['user_id' => $user[0]['id']]);
            
        }
        
        foreach($allUsers as $user) {           
            $currentUser = User::with('todos')->where('id', '=', $user->id)->first();
            $currentUser->todos()->detach();
        }

        Schema::table('todo_user', function (Blueprint $table) {
            $table->after('todo_id', function ($table) {
                $table->string('permission');
            });
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
