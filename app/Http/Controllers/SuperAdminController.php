<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Un Contreolleur qui gèrent la partie super admin
 * Cette partie du contolleur est gérer par un middleware SuperAdmin qui verifie 
 * les utilisateurs qui peut acceder à cette partie de notre application
 * @author NARIHY <maheninarandrianarisoa@gmail.com>
 * @copyright 2023 NARIHY
 */
class SuperAdminController extends Controller
{
    /**
     * Retourne la vue principale de l'interface super administrateur
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view($this->viewPath(). 'index');
    }

    private function viewPath(): string 
    {
        return "super-admin.";
    }
}
