<x-layout :pageTitle="$perfil->nome">
    <x-slot name="content">
        <div class="mx-auto max-w-screen-lg">
            <h2 class="text-violet-700 text-4xl mb-7">
                {{ $perfil->nome }}
            </h2>
            <p class="text-xl">
                {{ $perfil->descricao }}
            </p>
            <div class="flex justify-between mt-6 pt-6 px-3 border-t border-gray-200">
                <form action="{{ route('perfis.destroy', ['perfil' => $perfil->id]) }}" method="POST"
                    onsubmit="return confirm('Desja realmente deletar esse perfil?')">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="text-gray-500 hover:text-gray-700 underline">Deletar</button>
                </form>
                <x-primary-button link="{{ route('perfis.edit', ['perfil' => $perfil->id]) }}">
                    Editar
                </x-primary-button>
            </div>
        </div>
    </x-slot>
</x-layout>