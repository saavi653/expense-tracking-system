<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Expense extends Model
{
    use HasFactory, Sluggable ;
    protected $fillable=[
        
        'name',
        'slug',
        'cost',
        'date',
        'category_id',
        'url',
        'month'
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, array $key)
    {
        if($key==null)
        {
            return $query->orderby('date', 'desc');
        }
        elseif(isset($key['sort']))
        {
            if($key['sort']=='thisweek')
            {
                return $query->whereBetween('date', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()
                ]);
            }
            elseif($key['sort']=='lastweek')
            {
                 return $query->whereBetween('date', [
                    Carbon::now()->startOfWeek()->subWeek(),
                    Carbon::now()->endOfWeek()->subWeek()
                ]);
            }
            elseif($key['sort']=='thismonth')
            {
                return $query->whereBetween('date', [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()
                ]);
            }
            elseif($key['sort']=='lastmonth')
            {
                return $query->whereBetween('date', [
                    Carbon::now()->subMonth()->startOfMonth(),
                    Carbon::now()->subMonth()->endOfMonth()
                ]);
            }
        }
        else
        {
            return $query->wherebetween('date', [$key['from'], $key['to']]);
        }   
    }    
}
