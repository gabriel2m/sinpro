<?php

namespace App\Models;

use App\Models\Traits\TableName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $compra_id
 * @property Compra $compra
 * @property int $material_unidade_id
 * @property MaterialUnidade $material_unidade
 * @property MaterialCompraQuantidade[]|HasMany $quantidades
 * @property MaterialCompraValor[]|HasMany $valores
 * @property string $responsavel_valores
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class MaterialCompra extends Model
{
    use HasFactory;
    use TableName;

    protected $table = 'materiais_compras';

    protected $fillable = [
        'compra_id',
        'material_unidade_id',
        'responsavel_valores'
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    public function material_unidade()
    {
        return $this->belongsTo(MaterialUnidade::class)->withTrashed();
    }

    public function quantidades()
    {
        return $this
            ->hasMany(MaterialCompraQuantidade::class)
            ->join(Setor::tableName(),  MaterialCompraQuantidade::columnName('setor_id'), Setor::columnName('id'))
            ->orderBy(Setor::columnName('nome'));
    }

    public function valores()
    {
        return $this->hasMany(MaterialCompraValor::class);
    }
}
