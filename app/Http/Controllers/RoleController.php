<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolesCreationRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Un controlleur qui gèrent tous les type de rôle 
 * disponible dans notre application, seule un super-admin peut y 
 * acceder a cette partie du site.
 * Ce controlleur etant de notre model ROLE
 * @author NARIHY <maheninarandrianarisoa@gmail.com>
 * @copyright 2023 NARIHY
 */
class RoleController extends Controller
{
    /**
     * Ce méthode permet de lister tous les rôles disponible 
     * dans notre application dans une vue en particulier.
     * @return \Illuminate\View\View
     */
    public function listing(): View
    {
        /** @var Role $role // Récupération de tous les rôle disponible dans notre application */
        $role = Role::get();
        return view($this->viewPath().'role', [
            'role' => $role
        ]);
    }

    /**
     * Retourne seulement la vue de création d'un rôle
     * @return \Illuminate\View\View
     */
    public function create(): View 
    {
        return view($this->viewPath().'action.role');
    }

    /**
     * Ce méthode permet de sauvgarder les données entrer par un super admin
     * lors de l'ajout d'un rôle dans la base de donnée.
     * les rôles sont relier aux model utilisateurs
     * @param \App\Http\Requests\RolesCreationRequest $rolesCreationRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RolesCreationRequest $rolesCreationRequest): RedirectResponse 
    {
        /** @var RolesCreationRequest $data data ici est une instance des données valider */
        $data = $rolesCreationRequest->validated();
        //bouclons dans try catch pour mieux simuler les erreurs
        try {
            /** @var Role $role est ici une instance de la création d'un élément dans rôle */
            $role = Role::create($data);
            return redirect()->route($this->routes().'listing')->with('success', 'Ajout du rôle réussi');
        } catch (\Exception $e) {
            return redirect()->route($this->routes().'create')->with('error', 'il y a eu une erreur: '. $e->getMessage());
        }
        
    }

    /**
     * Ce méthode retourne directement la vue qui permet
     * de modifier un rôle en particulier
     * @param string $roleId C'est l'id du role à modifier
     * @return \Illuminate\View\View
     */
    public function edit(string $roleId): View 
    {
        /** @var Role $role est une instance d'un role dans la base de donnée */
        $role = Role::findOrFail($roleId);
        return view($this->viewPath().'action.role', [
            'role' => $role
        ]);
    }


    /**
     * Permet de mettre a jours les informations dans la base de donne
     * elle retourne une redirection d'url
     * @param \App\Http\Requests\RolesCreationRequest $rolesCreationRequest c'est les regle de validation
     * @param string $roleId c'est l'id du role a modifier
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function update(RolesCreationRequest $rolesCreationRequest, string $roleId): RedirectResponse 
    {
        /** @var RolesCreationRequest $data data ici est une instance des données valider */
        $data = $rolesCreationRequest->validated();
        try {
            /** @var Role $role est une instance d'un role dans la base de donnée */
            $role = Role::findOrFail($roleId);
           $role->update($data);
            return redirect()->route($this->routes().'edit',['roleId' => $roleId])->with('success', 'Modification réussi');
        } catch (\Exception $e) {
            return redirect()->route($this->routes().'edit',['roleId' => $roleId])->with('error', 'echec de la modification'. $e->getMessage());
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
        return "Connected.SuperAdmin.CompteManagement.Role.";
    }
}
