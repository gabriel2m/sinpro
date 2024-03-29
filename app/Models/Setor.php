<?php

namespace App\Models;

use App\Models\Traits\TableName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $nome
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Setor extends Model
{
    use HasFactory;
    use SoftDeletes;
    use TableName;

    protected $table = 'setores';

    protected $guarded = [];
}
