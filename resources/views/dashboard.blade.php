<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Painel da Assistência Social') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4">Bem-vindo ao painel de administração da assistência social de Bebedouro.</p>
                    <p class="mb-4">Este é o espaço dedicado ao gerenciamento das notícias do portal e à criação de novos usuários administradores.</p>
                    <p>Aqui você pode atualizar, adicionar e remover notícias, além de gerenciar usuários administradores.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
