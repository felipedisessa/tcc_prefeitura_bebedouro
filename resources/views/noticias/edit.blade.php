<!-- resources/views/noticias/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Notícia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <form action="{{ route('noticias.update', $noticia->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $noticia->name) }}"
                                class="text-white mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ 'O campo nome é obrigatório' }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição</label>
                            <textarea name="description" id="description" rows="3"
                                class="text-white mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('description', $noticia->description) }}</textarea>
                            @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ 'O campo descrição é obrigatório' }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="noticia_image"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Imagem</label>
                            <input type="file" name="noticia_image" id="noticia_image"
                            class="text-white mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>

                        @if($noticia->uploads->isNotEmpty())
                        <div class="mb-4">
                            <label for="noticia_image"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Imagem Atual</label>
                                <img src="{{ asset('storage/' . $noticia->uploads->first()->file_path) }}" alt="{{ $noticia->name }}">
                        </div>
                        @endif

                        <div>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Atualizar
                                Notícia</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
