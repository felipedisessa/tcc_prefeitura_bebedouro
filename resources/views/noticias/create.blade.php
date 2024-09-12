<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Criar Notícia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <form action="{{ route('noticias.store') }}" method="POST" enctype="multipart/form-data" id="createNoticiaForm">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Título da Notícia"
                                   class="text-white mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <div id="nameError" class="text-red-500 text-xs mt-1"></div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição</label>
                            <textarea name="description" id="description" rows="3" placeholder="Escreva o conteúdo da Notícia"
                                      class="text-white mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
                            <div id="descriptionError" class="text-red-500 text-xs mt-1"></div>
                        </div>

                        <div class="mb-4">
                            <label  for="noticia_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Escolher Imagem</label>
                            <input accept="image/*" id="noticia_image" name="noticia_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file">
                            <div id="imageError" class="text-red-500 text-xs mt-1"></div>
                        </div>

                        <div>
                            <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Criar
                                Notícia</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@vite('resources/js/news.js')
