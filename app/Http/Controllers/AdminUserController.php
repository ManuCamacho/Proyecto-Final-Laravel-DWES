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
        // Obtiene el ID del usuario autenticado
        $loggedInUserId = Auth::id();
        
        // Valida los datos del formulario
        $validation = $request->validate([
            'usertype' => 'required|in:user,admin', // Asegura que el tipo de usuario sea 'user' o 'admin'
        ]);

        try {
            // Busca el usuario por su ID
            $user = User::findOrFail($id);

            // Verifica si el usuario a actualizar es la cuenta de administrador especial
            if ($user->email === 'manuelcamacholaravel@gmail.com') {
                return redirect()->route('admin.users.index')->with('error', 'No puedes modificar la cuenta de administrador especial.');
            }
            
            // Verifica si el usuario a actualizar es el usuario autenticado
            if ($user->id === $loggedInUserId) {
                throw new \Exception('No puedes modificar tu propia cuenta.');
            }

            // Actualiza el tipo de usuario
            $user->usertype = $validation['usertype'];

            // Guarda el usuario actualizado
            $user->save();

            // Redirige al listado de usuarios con mensaje de éxito
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
            // Obtiene el usuario actualmente autenticado
            $loggedInUser = Auth::user();
        
            // Busca el usuario a eliminar
            $userToDelete = User::findOrFail($id);
        
            // Verifica si el usuario a eliminar es el usuario autenticado
            if ($userToDelete->id === $loggedInUser->id) {
                throw new \Exception('No puedes eliminar tu propia cuenta.');
            }
        
            // Verifica si el usuario a eliminar es la cuenta de administrador especial
            if ($userToDelete->email === 'manuelcamacholaravel@gmail.com') {
                throw new \Exception('No puedes eliminar la cuenta de administrador especial.');
            }
        
            // Elimina el usuario
            $userToDelete->delete();
        
            // Redirige con mensaje de éxito
            return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
}
