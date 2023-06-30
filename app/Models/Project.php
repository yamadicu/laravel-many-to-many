<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Admin\Category;
use App\Models\Admin\Technology;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project';

    protected $fillable = [
        "title",
        "content",
        "cover_image",
        "slug",
        "category_id"
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }
}
