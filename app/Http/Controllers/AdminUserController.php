<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador para la gestión de usuarios por parte del administrador.
 */
class AdminUserController extends Controller
{
    /**
     * Muestra una lista de todos los usuarios.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    
    /**
     * Actualiza el tipo de usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateType(Request $request, $id)
    {
        // Obtener el ID del usuario autenticado
        $loggedInUserId = Auth::id();
        
        // Validar los datos del formulario
        $validation = $request->validate([
            'usertype' => 'required|in:user,admin', // Asegura que el tipo de usuario sea 'user' o 'admin'
        ]);

        try {
            // Buscar el usuario por su ID
            $user = User::findOrFail($id);

            // Verificar si el usuario a actualizar es la cuenta de administrador especial
            if ($user->email === 'manuelcamacholaravel@gmail.com') {
                return redirect()->route('admin.users.index')->with('error', 'No puedes modificar la cuenta de administrador especial.');
            }
            
            // Verificar si el usuario a actualizar es el usuario autenticado
            if ($user->id === $loggedInUserId) {
                throw new \Exception('No puedes modificar tu propia cuenta.');
            }

            // Actualizar el tipo de usuario
            $user->usertype = $validation['usertype'];

            // Guardar el usuario actualizado
            $user->save();

            // Redirigir al listado de usuarios con mensaje de éxito
            return redirect()->route('admin.users.index')->with('success', 'Tipo de usuario actualizado correctamente.');
        } catch (\Exception $e) {
            // Capturar excepciones (por ejemplo, validación fallida o intento de modificar la cuenta especial)
            return redirect()->route('admin.users.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Elimina un usuario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Obtener el usuario actualmente autenticado
            $loggedInUser = Auth::user();
        
            // Buscar el usuario a eliminar
            $userToDelete = User::findOrFail($id);
        
            // Verificar si el usuario a eliminar es el usuario autenticado
            if ($userToDelete->id === $loggedInUser->id) {
                throw new \Exception('No puedes eliminar tu propia cuenta.');
            }
        
            // Verificar si el usuario a eliminar es la cuenta de administrador especial
            if ($userToDelete->email === 'manuelcamacholaravel@gmail.com') {
                throw new \Exception('No puedes eliminar la cuenta de administrador especial.');
            }
        
            // Eliminar el usuario
            $userToDelete->delete();
        
            // Redirigir con mensaje de éxito
            return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            // Capturar excepciones
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
