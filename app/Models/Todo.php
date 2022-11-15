<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'categories_id',
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('id', 'tag_id', 'todo_id');
    }

    public function getTagNamesAttribute()
    {
        
        return array_map(function ($tag) {
            return ['name' => $tag['name'], 'color' => $tag['color']];
        },$this->tags->toArray());
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('id', 'todo_id', 'user_id');
    }

}
