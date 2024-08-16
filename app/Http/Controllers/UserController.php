<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * fonction permettant de bloquer un utilisateur
     * @param string|int $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function blockUser(string|int $id)
    {
        $user = User::find($id); // on recherche la personne à bloquer

        if ($user) {
            $user->blocked_at = now();
            $user->save();
            return response()->json(["message" => "Utilisateur bloqué avec succès !"]);
        }
        return response()->json(["message" => "L'utilisateur n'a pas été trouvé !"], 404);
    }

    /**
     * fonction permettant de débloquer un utilisateur
     * @param string|int $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function unblockUser(string|int $id)
    {
        $user = User::find($id); // on recherche la personne à bloquer

        if ($user) {
            $user->blocked_at = null;
            $user->save();
            return response()->json(["message" => "Utilisateur débloqué avec succès !"]);
        }
        return response()->json(["message" => "L'utilisateur n'a pas été trouvé !"], 404);
    }
}
