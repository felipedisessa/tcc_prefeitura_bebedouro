@php use Carbon\Carbon; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Painel da Assistência Social') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-10">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6 p-4 bg-gray-100 dark:bg-gray-800 rounded-lg">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                            {{ __('Bem-vindo ao Painel de Notícias, :name', ['name' => Auth::user()->name]) }}
                        </h3>
                        <p class="text-gray-800 dark:text-gray-300">
                            {{ __('Aqui você pode gerenciar todas as notícias do sistema. Use os botões abaixo para criar, editar ou excluir notícias. Aproveite as funcionalidades e mantenha as informações sempre atualizadas.') }}
                        </p>
                    </div>


                    <div class="flex justify-between items-center mb-6">
                        <a href="{{ route('noticias.create') }}"
                           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Criar Notícia
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-blue-500 text-white p-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-500 text-white p-4 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Título') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Responsável') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Data de Criação') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Ação') }}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($noticias as $noticia)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $noticia->name }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                                        {{ $noticia->user->name ?? 'Usuário desativado' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 text-sm">
                                        {{ Carbon::parse($noticia->created_at)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('noticias.edit', $noticia->id) }}"
                                               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                Editar
                                            </a>
                                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                                    data-id="{{ $noticia->id }}" type="button"
                                                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                Deletar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@if(isset($noticia))
    @include('noticias.modal.destroy')
@endif
@vite('resources/js/news.js')
