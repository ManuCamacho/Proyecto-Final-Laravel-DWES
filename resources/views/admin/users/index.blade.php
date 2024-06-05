<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0">Listado de Usuarios</h1>
                    </div>
                    <hr />
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Publicidad</th> 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $user->name }}</td>
                                    <td class="align-middle">{{ $user->surname }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">
                                        <form action="{{ route('update.type', $user->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <select name="usertype" onchange="this.form.submit()">
                                                <option value="user" {{ $user->usertype == 'user' ? 'selected' : '' }}>User</option>
                                                <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="align-middle">{{ $user->accepts_marketing ? 'Sí' : 'No' }}</td> 
                                    <td class="align-middle">
                                        <!-- Botón para eliminar usuario -->
                                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">No hay usuarios registrados</td> <!-- Ajuste en el colspan -->
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
