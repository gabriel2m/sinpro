@extends('admin.unidades.base')

@php
    $title[] = $unidade->nome;
    $breadcrumb = [
        [
            'link' => route('admin.unidades.index'),
            'label' => 'Unidades de medida',
        ],
        [
            'label' => $unidade->nome,
            'active' => true,
        ],
    ];
@endphp

@prepend('styles')
@endprepend

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table show-table w-100">
                <tbody>
                    @foreach ([
            'nome' => 'Unidade',
        ] as $attr => $label)
                        <tr>
                            <th>
                                {{ $label }}
                            </th>
                            <td>
                                {{ $unidade->$attr }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex mt-3">
        <div class="ml-auto">
            <a href="{{ route('admin.unidades.edit', $unidade) }}" class="btn btn-primary">
                <i class="la-lg las la-edit"></i>
                Editar
            </a>
            <button type="button" class="btn btn-danger ml-3" data-toggle="modal" data-target="#delete-modal">
                <i class="la-lg las la-trash"></i>
                Deletar
            </button>

            <!-- Modal -->
            <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            Deseja realmente deletar?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary m-0" data-dismiss="modal">
                                <i class="la-lg las la-times-circle"></i>
                                Cancelar
                            </button>
                            <form action="{{ route('admin.unidades.destroy', $unidade) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ml-3">
                                    <i class="la-lg las la-trash"></i>
                                    Deletar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@prepend('scripts')
@endprepend
