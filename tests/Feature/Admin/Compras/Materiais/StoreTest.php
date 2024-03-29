<?php

namespace Tests\Feature\Admin\Compras\Materiais;

use App\Models\Compra;
use App\Models\MaterialCompra;
use App\Models\MaterialCompraQuantidade;
use App\Models\MaterialCompraValor;
use App\Models\MaterialUnidade;
use Tests\TestCase;

class StoreTest extends TestCase
{
    public function test_put()
    {
        $material_unidade = MaterialUnidade::factory()->create();
        $compra = Compra::factory()->create();

        $material_compra_data = MaterialCompra::factory()->raw([
            'material_unidade_id' => $material_unidade,
            'compra_id' => $compra,
        ]);

        $quantidade_data = MaterialCompraQuantidade::factory()->raw([
            'material_compra_id' => null,
        ]);

        $valor_data = MaterialCompraValor::factory()->raw([
            'material_compra_id' => null,
        ]);

        $this
            ->actingAsAdmin()
            ->post(
                route('admin.compras.materiais.store', [
                    'compra' => $compra->ano
                ]),
                [
                    ...$material_compra_data,
                    'quantidades' => [
                        $quantidade_data
                    ],
                    'valores' => [
                        $valor_data
                    ]
                ]
            )
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas(MaterialCompra::class, $material_compra_data);
        $this->assertDatabaseCount(MaterialCompra::class, 1);

        $quantidade_data['material_compra_id'] = 1;
        $this->assertDatabaseHas(MaterialCompraQuantidade::class, $quantidade_data);
        $this->assertDatabaseCount(MaterialCompraQuantidade::class, 1);

        $valor_data['material_compra_id'] = 1;
        $this->assertDatabaseHas(MaterialCompraValor::class, $valor_data);
        $this->assertDatabaseCount(MaterialCompraValor::class, 1);
    }
}
