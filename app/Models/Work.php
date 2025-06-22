<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Work extends Model
{
    protected $fillable = ['title', 'slug', 'user_id', 'category_id', 'thumbnail', 'excerpt', 'link', 'has_page', 'description', 'published_at'];
    protected $casts = ['has_page' => 'boolean']; // Otomatis ubah nilai 0/1 ↔ false/true
    protected $with = ['user', 'category'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

    #[Scope]
    public function filter(Builder $query, array $filters): void{

        $query->when($filters['searching'] ?? false, function($query, $search){
            return $query->where('title', 'like', '%' . $search. '%');
        });
        $query->when($filters['category'] ?? false, function($query, $category){
            return $query->whereHas('category', function(Builder $query)  use ($category){
                $query->where('slug', $category);
            } );
        });
        $query->when($filters['creator'] ?? false, function($query, $creator){
            return $query->whereHas('user', function(Builder $query)  use ($creator){
                $query->where('username', $creator);
            } );
        });
    }

}
