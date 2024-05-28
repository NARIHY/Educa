<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdateInformationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Ce controlleur gèrent la gestion des profiles pour les utilisateur
 * qui ont pour rôle Super Admin. Dans cette gestion de profile, l'utilisateur 
 * peut modifier ces information ou même suprimer son compte.
 * @author NARIHY <maheninarandrianarisoa@gmail.com>
 * @copyright 2023 NARIHY
 */
class ProfileSuperAdminController extends Controller
{
    /**
     * Récuperer l'utilisateur connecter et le renvoye dans la vue adequat pour
     * qu'il/Elle puisse modifier ses information personnelle
     * On a besoin de Auth pour récupérer l'utilisateur connecter
     * @return \Illuminate\View\View
     */
    public function profile () : View
    {
        /** @var Auth $profile Profile ici est l'instance de l'utilisateur connecter */
        $profile = Auth::user();
        return view($this->viewPath().'profile', [
            'profile' => $profile
        ]);
    }

    /**
     * Retourne tous les parametre disponible que l'utilisateur 
     * peut faire pour modifier ses informations personnelles
     * On injecte seulement l'utilisateur connecter dans la vue
     * @return \Illuminate\View\View
     */
    public function setting(): View 
    {
        /** @var Auth $profile Profile ici est l'instance de l'utilisateur connecter */
        $profile = Auth::user();
        return view($this->viewPath().'action.setting', [
            'profile' => $profile
        ]);
    }

    /**
     * Supression du compte de l'utilisateur actuel
     * Récuperer l'utilisateur connecter
     * ensuite Le deconnecter et enfin suprimer l'utilisateur
     * On le redirige vers l'acceuil du site
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        /** @var User $user Récuperation de l'utilisateur connecter */
        $user = $request->user();
        Auth::logout();
        //supression de l'utilisateur
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect()->route('Public.interface');
    }

    /**
     * Retourn uniquement la vue d'edition du mots de passe
     * @return \Illuminate\View\View
     */
    public function passwordUpdate(): View 
    {
        return view($this->viewPath().'action.setting.update-password');
    }

    /**
     * Ce méthode permet d'editer le profile de l'utilisateur
     * qui est connecter, il n'a pas beaucoup de parametre 
     * mais on récupèrent seulement l'utilisateur connecter
     * et on l'injecte dans la vue
     * @return \Illuminate\View\View
     */
    public function editInformation(): View 
    {
        /** @var Auth $profile Profile ici est l'instance de l'utilisateur connecter */
        $profile = Auth::user();
        return view($this->viewPath().'action.setting.update-profile', [
            'profile' => $profile
        ]);
    }


    /**
     * Ce méthode permet de sauvgarder les mis à jour
     * des informations fait par l'utilisateur actuelle
     * il ne reste qu'amoindrir le code pour avoir une 
     * meilleur perfomance de notre plateforme
     * @param \App\Http\Requests\UpdateInformationRequest $updateInformationRequest // c'est notre méthode de validation injecter
     * @param \App\Http\Requests\ProfileUpdateRequest $request // Pour la validation d'email si l'email a été modifier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInformation(UpdateInformationRequest $updateInformationRequest, ProfileUpdateRequest $request): RedirectResponse
    {
        /** @var array $data Récupération des information valider dans un nouveau tableau */
        $data = $updateInformationRequest->validated();
        /** @var $picture C'est le photo de profile de l'utilisateur valider */
        $picture = $updateInformationRequest->validated('picture');
        /** @var User $profile Récupération de l'utilisateur connecter */
        $profile = Auth::user();
        try {
            //On sauvgarde les Mis à jours
            $profile->update($data);
            // Verification si il y a une photo ou pas
            if (empty($picture)){
                $picture = $profile->picture;
            } else {
                //Sauvgarde de l'image dans la base de donnée
                $pic['picture'] = $picture->store('users', 'public');
                $profile->update($pic);
            }
            //Pour la validation d'email
            $request->user()->fill($request->validated());
                if ($request->user()->isDirty('email')) {
                    $request->user()->email_verified_at = null;
                }
            $request->user()->save();
            return redirect()->route($this->routes().'editInformation')->with('success', 'Mis à jour réussi.');
        } catch (\Exception $e) {
            return redirect()->route($this->routes().'editInformation')->with('error', 'Il y a eu une erreur lors du mis à jour: ' . $e->getMessage());
        }
    }

    /**
     * Retourne le chemin de la vue adéquat en chaine de caractere
     * chemin originale + chemin cible
     * @return string
     */
    private function viewPath(): string
    {
        return "super-admin.profile.";
    }

    /**
     * Retourne le nom de la route générale en chaine de caractere
     * Route originale + route cible
     * @return string
     */
    private function routes(): string
    {
        return "Connected.SuperAdmin.Profile.SuperAdmin.";
    }
}
