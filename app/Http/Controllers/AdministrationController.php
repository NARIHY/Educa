<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Un controlleur qui gèrent seulement les parties visible de notre administratiion
 * Un peut comme un petit carreffour.
 * Tous le monde a le droit d'acceder a cette partie de l'application 
 * Mais seulement c'est le seule accès que possèdent les élèves , les profésseurs, les services clients et aides Publicitaire
 * Service client = Personne qui est responsable des message envoyer par des utilisateur, des aides au profésseurs ou au public, les publicités du site 
 * @author NARIHY <maheninarandrianarisoa@gmail.com>
 * @copyright 2023 NARIHY
 */
class AdministrationController extends Controller
{
    /**
     * Retourne la partie visuel de l'administration Eleve et Proffesseur
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view($this->viewPath().'index');
    }

    /**
     * Chemin absoolu de notre vue
     * @return string
     */
    private function viewPath(): string 
    {
        return "admin.";
    }
}
