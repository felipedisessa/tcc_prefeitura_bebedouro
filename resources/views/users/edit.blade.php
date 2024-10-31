<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Usuário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <form action="{{ route('users.updateUser', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" placeholder="Nome do Usuário"
                                   class="dark:text-white text-black mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <div id="nameError" class="text-red-500 text-xs mt-1"></div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">E-mail</label>
                            <input name="email" id="email" type="email" placeholder="exemplo@exemplo.com"
                                   class="dark:text-white text-black mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                   value="{{ $user->email }}">
                            <div id="emailError" class="text-red-500 text-xs mt-1"></div>
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Permissão</label>
                            <select name="role" id="role" class="text-black dark:text-white mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="administrador" {{ $user->role == 'administrador' ? 'selected' : '' }}>Administrador</option>
                                <option value="publicador" {{ $user->role == 'publicador' ? 'selected' : '' }}>Publicador</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="document" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Documento</label>
                            <input name="document" id="document" type="text" placeholder="Somente Números"
                                   class="dark:text-white text-black mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                   value="{{ $user->document }}">
                            <div id="documentError" class="text-red-500 text-xs mt-1"></div>
                        </div>

                        <div>
                            <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600
                                dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Editar Usuário</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@vite('resources/js/users.js')
