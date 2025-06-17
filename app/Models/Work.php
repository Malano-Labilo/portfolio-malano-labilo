<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Work extends Model
{
    protected $fillable = ['title', 'slug', 'author' ];
    // protected $with = ['user', 'category'];

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
