<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'image', 'description'];

    public function seasons() {
        return $this->belongsToMany(Season::class)->withTimestamps();
    }

    public function scopeProductNameSearch($query,$name)
    {
        if (!empty($name)) {
            $query->where('name', 'like', '%'. $name . '%');
        }
    }

    public function order($select)
    {
        if($select == 'asc') {
            return self::orderBy('price', 'asc');
        } elseif($select == 'desc') {
            return self::orderBy('price', 'desc');
        }
    }

    public function scopeProductIdSearch($query,$id)
    {
        if (!empty($id)) {
            $query->where('id',$id);
        }
    }

}
