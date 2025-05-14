<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function product() {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function scopeSeasonSearch($query,$name)
    {
        if (!empty($name)) {
            $query->where('name',$name);
        }
    }
}
