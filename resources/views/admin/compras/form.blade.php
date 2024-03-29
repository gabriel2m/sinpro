@extends('admin.compras.base')

@php
    $breadcrumb = [
        [
            'link' => route('admin.compras.index'),
            'label' => 'Compras',
        ],
    ];
    if ($compra->exists) {
        $title = ['Editar', $compra->getOriginal('ano')];
        array_push(
            $breadcrumb,
            [
                'label' => $compra->getOriginal('ano'),
                'link' => route('admin.compras.show', $compra),
            ],
            [
                'label' => 'Editar',
                'active' => true,
            ],
        );
    } else {
        $title = ['Adicionar'];
        array_push($breadcrumb, [
            'label' => 'Adicionar',
            'active' => true,
        ]);
    }
@endphp

@section('content')
    <form method="POST"
        action="{{ $compra->exists ? route('admin.compras.update', $compra->getOriginal('ano')) : route('admin.compras.store') }}"
        class="form-primary" autocomplete="off">
        @csrf
        @if ($compra->exists)
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>
                        Ano
                    </label>
                    <input type="text" name="ano" class="form-control" value="{{ $compra->ano }}" required>
                    <x-input-error input='ano' />
                </div>
            </div>
        </div>

        <div class="d-flex mt-3">
            <div class="ml-auto">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="la-lg las la-times-circle"></i>
                    Cancelar
                </a>
                <button type="submit" class="btn btn-success ml-3">
                    <i class="la-lg las la-save"></i>
                    Salvar
                </button>
            </div>
        </div>
    </form>
@endsection
