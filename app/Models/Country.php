<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Continent;
class Country extends Model
{
    use HasFactory;
    protected $fillable = ["continent_id","country_name","capital_name"];
    public function continent(){
        return $this->belongsTo(Continent::class);
    }

    public function scopeSearch($query,$term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('country_name',"like",$term)
            ->orWhere('capital_name',"like",$term);
        });
        
    }
}
