<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function product()
    {
        $this->hasMany(Product::class);
    }

    // here category follow just for one parent
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    // the one category possible one or more child
    public function children()
    {
        // I here put withDefault because foreign key possible be nullable
        return $this->hasMany(Category::class, 'parent_id', 'id')
            ->withDefault();
    }
}
