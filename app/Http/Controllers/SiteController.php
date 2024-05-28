<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 *  C'est un petit carrefour qui gèrent presque tous les 
 *  vues public de notre application
 *  @author NARIHY <Maheninarandrianarisoa@gmail.com>
 * @copyright 2023 NARIHY
 */
class SiteController extends Controller
{
    /**
     * Permet de nous renvoyer vers l'acceuil
     * Aucun parametre pour l'instant
     * @return \Illuminate\View\View
     */
    public function interface(): View
    {
        return view($this->viewPath().'interface.index');
    }

    /**
     * Permet de nous renvoyer vers un forum de discution
     * Aucun parametre pour l'instant
     * @return \Illuminate\View\View
     */
    public function forum(): View 
    {
        return view($this->viewPath().'forum.index');
    }

    /**
     * Permet de nous renvoyer vers les cours pour le moment
     * Aucun parametre pour l'instant
     * @return \Illuminate\View\View
     */
    public function cours(): View 
    {
        return view($this->viewPath().'cours.index');
    }

    /**
     * Permet de nous renvoyer ves les propos de notre aplication
     * Aucun parametre pour l'instant
     * @return \Illuminate\View\View
     */
    public function propos(): View 
    {
        return view($this->viewPath(). 'propos.index');
    }

    /**
     * Permet de nous renvoyer ves les evenement de notre aplication
     * Aucun parametre pour l'instant
     * @return \Illuminate\View\View
     */
    public function evenement(): View 
    {
        return view($this->viewPath(). 'evenement.index');
    }

    /**
     * Permet de nous renvoyer ves les contact de notre aplication
     * Aucun parametre pour l'instant
     * @return \Illuminate\View\View
     */
    public function contact(): View 
    {
        return view($this->viewPath(). 'contact.index');
    }
    /**
     * !!IMPORTANT
     * Chemin realtif des fichier ou dossier dans public
     * @return string
     */
    private function viewPath(): string 
    {
        return 'public.';
    }
    
    /**
     * !!IMPORTANT
     * Permet de limiter d'ajouter le mots Public a chaque redirection
     * @return string
     */
    private function routeName(): string 
    {
        return 'Public.';
    }
}
