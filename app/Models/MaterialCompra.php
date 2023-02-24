<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $compra_id
 * @property Compra $compra
 * @property integer $material_id
 * @property Material $material
 * @property MaterialCompraSetor[] $material_compra_setores
 * @property float $valor
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class MaterialCompra extends Model
{
    use HasFactory;

    protected $table = 'materiais_compras';

    protected $fillable = [
        'compra_id',
        'material_id',
        'valor'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class)->withTrashed();
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class)->withTrashed();
    }

    public function setores()
    {
        return $this->belongsToMany(Setor::class, 'materiais_compras_setores')->withPivot('quantidade')->orderBy('nome');
    }
}