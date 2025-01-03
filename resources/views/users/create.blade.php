<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Criar Usuário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    @if ($errors->any())
                        <div class="mb-4 text-red-500 text-sm">
                            <strong>Houve um problema ao criar o usuário:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Nome do Usuário"
                                   class="dark:text-white text-black mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <div id="nameError" class="text-red-500 text-xs mt-1"></div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">E-mail</label>
                            <input name="email" id="email" type="email" placeholder="exemplo@exemplo.com"
                                   class="dark:text-white text-black mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                   value="{{ old('email') }}">
                            <div id="emailError" class="text-red-500 text-xs mt-1"></div>
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Permissão</label>
                            <select name="role" id="role" class="dark:text-white text-black mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="administrador" {{ old('role') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                                <option value="publicador" {{ old('role') == 'publicador' ? 'selected' : '' }}>Publicador</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="document" class="block text-sm font-medium text-gray-700 dark:text-gray-300">CPF</label>
                            <input name="document" id="document" type="text" placeholder="Somente Números"
                                   class="dark:text-white text-black mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                   value="{{ old('document') }}">
                            <div id="documentError" class="text-red-500 text-xs mt-1"></div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Senha</label>
                            <input name="password" id="password" type="password" placeholder="Minimo 8 Caracteres"
                                   class="dark:text-white text-black mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <div id="passwordError" class="text-red-500 text-xs mt-1"></div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmação de Senha</label>
                            <input name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirme a Senha"
                                   class="dark:text-white text-black mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <div id="passwordConfirmationError" class="text-red-500 text-xs mt-1"></div>
                        </div>

                        <div>
                            <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600
                                dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Criar Usuário</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@vite('resources/js/users.js')
