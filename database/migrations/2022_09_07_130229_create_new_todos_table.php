<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Todo;
use App\Models\Category;

return new class extends Migration
{
    /**
     * Updates and adds category related tables & collumns
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        //verander dit met de nieuwe code in Todocontroller
        $allTodosQuery = DB::table('todos')
            ->select(DB::raw('DISTINCT `category`'))
            ->get();

        $array = [];
        foreach($allTodosQuery as $categoryQuery) { // dd($categoryQuery->category);
            $category = new Category(['name' => $categoryQuery->category]);
            $category->save();
            $array[] = $category;
        };

        Schema::table('todos', function (Blueprint $table) {
            $table->after('id', function ($table) {
                $table->foreignId('categories_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            });
        });

        // Update Query loop door category array elke opgeslagen category update op database
        // elke todo waar de oude bestaat koppel de id die erbij hoort

        foreach($array as $category) {
            DB::table('todos')
            ->where('category', $category->name)
            ->update(['categories_id' => $category->id]);
        }

        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn('category');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
