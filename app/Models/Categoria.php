<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps=false;
    public function empresa(){
        return $this->hasMany(Empresa::class);
    }
}
