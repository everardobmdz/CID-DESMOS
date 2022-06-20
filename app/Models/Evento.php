<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Evento extends Model
{
    // use HasFactory;
    use Searchable;

    protected $table = 'eventos';


    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha'
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */

    public function toSearchableArray()
    {
        return [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
        ];
    }
    public function archivos(){
        return $this->hasMany(Archivo::class);
    }
 
}

