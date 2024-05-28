<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Cette controlleur gèrent la liste de nos employer
 * On récupèrent ici tous les utilisateur ou son rôle est différent de
 * Etudiant
 * @author NARIHY <maheninarandrianarisoa@gmail.com>
 * @copyright 2023 NARIHY
 */
class ListeDeNosEmployerController extends Controller
{
    /**
     * Cette méthode nous permet de lister tous nos employer
     * @return \Illuminate\View\View
     */
    public function liste(): View 
    {
        $employer = User::where('role','!=','1')
                            ->orderBy('created_at','desc')
                            ->get();
        return view($this->viewPath().'liste',[
            'employer' => $employer
        ]);
    }

    /**
     * Cette méthode priver nous permet de gérer nos chemin 
     * dynamiquement et facilement
     * @return string
     */
    private function viewPath(): string 
    {
        return "super-admin.service-client.liste-de-nos-employer.";
    }
}
