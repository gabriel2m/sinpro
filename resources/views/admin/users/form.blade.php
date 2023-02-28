@extends('admin.users.base')

@php
    $breadcrumb = [
        [
            'link' => route('admin.users.index'),
            'label' => 'Usuários',
        ],
    ];
    if ($user->exists) {
        $title = ['Editar', $user->getOriginal('nome')];
        array_push(
            $breadcrumb,
            [
                'label' => $user->getOriginal('nome'),
                'link' => route('admin.users.show', $user),
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
    <form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}"
        class="form-primary" autocomplete="off">
        @csrf
        @if ($user->exists)
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>
                        Usuário
                    </label>
                    <input type="text" name="nome" class="form-control" value="{{ $user->nome }}" required>
                    <x-input-error input='nome' />
                </div>
                <div class="form-group">
                    <label>
                        Email
                    </label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    <x-input-error input='email' />
                </div>
                <div class="form-group">
                    <label>
                        Senha
                    </label>
                    <input type="password" name="password" class="form-control" required>
                    <x-input-error input='password' />
                </div>
                <div class="form-group">
                    <label>
                        Confirmação Senha
                    </label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                    <x-input-error input='password_confirmation' />
                </div>
                <div class="form-group">
                    <label>
                        Nível
                    </label>
                    <select class="custom-select" name="nivel" required>
                        <option></option>
                        @foreach (NivelUser::cases() as $nivel)
                            <option value="{{ $nivel->value }}" @selected($user->nivel?->value == $nivel->value)>
                                {{ $nivel->label() }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error input='nivel' />
                </div>
            </div>
        </div>

        <div class="d-flex mt-3">
            <div class="ml-auto">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="far fa-times-circle"></i>
                    Cancelar
                </a>
                <button type="submit" class="btn btn-success ml-3">
                    <i class="far fa-hdd"></i>
                    Salvar
                </button>
            </div>
        </div>
    </form>
@endsection