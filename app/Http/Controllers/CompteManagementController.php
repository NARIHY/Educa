<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompteManagementUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Gèrent la gestion des utilisateurs:
 *  Se controlleur sert à voir, a modifier, ou a suprimer les utilisateur
 *  nb: On ne peut pas ajouter des utilisateur directement dans ce controlleur
 *      tous les utilisateur doivent s'inscrire pour pouvoir être modifier ici
 * @author NARIHY <maheninarandrianarisoa@gmail.com>
 * @copyright 2023 NARIHY
 */

class CompteManagementController extends Controller
{
    /**
     * Permet de lister les comptes
     * les éléments récuperer sont paginer de 10 par 10
     * retourne une instance user dans la vue associer
     * @return \Illuminate\View\View
     */
    public function listing (): View
    {
        /**
         * @var User $user || Recuperation des utilisateurs avec pagination
         */
        $user = User::orderBy('created_at', 'desc')
                        ->paginate(10);
        return view($this->viewPath().'index',[
            'user' => $user
        ]);
    }


    /**
     * Cette méthode retourne la vue d'édition d'un utilisateur
     * On injecte les rôle à l'intérieur pour pouvoir faire une relation simple
     * entre Utilisateur et rôle. Et pour faciliter la gestion des accès dans
     * notre plateforme e-learning.
     * Nb: Seulement le rôle de l'utilisateur peut être modifiable par le ou la
     *      Super-Administrateur
     * @param string $userId C'est l'id de l'utilisateur à modifier sous forme de chaine de caractere
     * @return \Illuminate\View\View
     */
    public function edit(string $userId): View 
    {
        /** @var User $user || Récupération de l'utilisateur à modifier */
        $user = User::findOrFail($userId);
        /** @var Role $role || Injecter les rôle dans la vue d'edition d'un user */
        $role = Role::pluck('id', 'title');
        return view($this->viewPath().'action.random',[
            'user' => $user,
            'role' => $role
        ]);
    }

    /**
     * Cette méthode permet de sauvgarder les modification fait
     * sur un utilisateur en particulier dans la vue d'édition
     * Utilisation de try catch pour mieux simuler les erreurs
     * @param \App\Http\Requests\CompteManagementUpdateRequest $compteRequest C'est les regle de validation
     * @param string $userId C'est l'id de l'utilisateur à modifier
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function update(CompteManagementUpdateRequest $compteRequest,string $userId): RedirectResponse
    {
        /** @var User $user || Récupération de l'utilisateur à modifier */
        $user = User::findOrFail($userId);
        /** @var array $data || innjection des donnée valider vers data */
        $data = $compteRequest->validated();
        try{
            //Mis a jour de les informations valider
            $user->update($data);
            return redirect()->route($this->routes().'edit', ['userId' => $userId])
                                    ->with('success', 'Edition du compte réussi');
        } catch(\Exception $e) {
            return redirect()->route($this->routes().'edit', ['userId' => $userId])
                                    ->with('error', 'Une erreur s\'est survenue lors de la modification'. $e->getMessage());
        }
    }

    /**
     * Cette méthode permet de suprimer un utilisateur en
     * particulier dans la base de donnée
     * @param string $userId C'est l'id de l'utilisateur à suprimer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(string $userId):RedirectResponse
    {
        /** @var User $user || Récupération de l'utilisateur à modifier */
        $user = User::findOrFail($userId);
        try {
            //suppression de l'utilisateur
            $user->delete();
            return redirect()->route($this->routes().'listing')
                            ->with('success', 'Supression de l\'utilisateur réussi');
        } catch(\Exception $e) {
            return redirect()->route($this->routes().'listing')
                                    ->with('error', 'Une erreur s\'est survenue lors de la supréssion'. $e->getMessage());
        }
    }

    /**
     * Chemin ou y est la vue des gestions de compte
     * @return string
     */
    private function viewPath(): string 
    {
        return "super-admin.comptemanagement.";
    }

    /**
     * Retourne les route associer aux gestion des comptes directement
     * @return string
     */
    private function routes(): string 
    {
        return "Connected.SuperAdmin.CompteManagement.Compte.";
    }
}
