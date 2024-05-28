<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcceuilInterfaceAjoutRequest;
use App\Http\Requests\AcceuilInterfaceMajRequest;
use App\Models\AcceuilInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Ce controlleur nous permet de gérer les différente aspect
 * modifiable et éditable de notre application
 * On peut ajouter, éditer ou mêmes suprimer
 * @author NARIHY <maheninarandrianarisoa@gmail.com>
 * @copyright 2023 NARIHY
 */
class AcceuilInterfaceControlleur extends Controller
{
    /**
     * Cette méthode nous permet de lister tous les publication disponible
     * qu'on peut ajouter à l'acceuil. Mais les publication à quoi on affiche est 
     * limiter à 1
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $acceuilInterface = AcceuilInterface::orderBy('created_at','desc')
                                                ->where('suprimer', '!=', '1')
                                                ->paginate(10);
        return view($this->viewPath().'index', [
            'acceuilInterface' => $acceuilInterface
        ]);
    }

    
    /**
     * Ce méthode nous permet de se diriger vers
     * la vue de création d'une nouvelle publication
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view($this->viewPath().'action.random');
    }

    
    /**
     * Cette méthode nous permet de sauvgarder les informations
     * remplis par l'utilisateur
     * @param \App\Http\Requests\AcceuilInterfaceAjoutRequest $acceuilInterfaceAjoutRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AcceuilInterfaceAjoutRequest $acceuilInterfaceAjoutRequest): RedirectResponse
    {
        /** @var array $data Récupération des données valider */
        $data = $acceuilInterfaceAjoutRequest->validated();
        try {
            //Sauvgarde dans la base de données
            $acceuilInterface = AcceuilInterface::create($data);
            //Image est une instance d'une image valider
            $image = $acceuilInterfaceAjoutRequest->validated('image');
            $img['image'] = $image->store('acceuil_interface', 'public');
            $acceuilInterface->update($img);
            return redirect()->route($this->routes(). 'index')->with('success','Ajout de la publication réussi');
        } catch (\Exception $e) {
            return redirect()->route($this->routes(). 'index')->with('error','Il y a eu une erreur lors de l\'ajout'. $e->getMessage());
        }
    }

    
    /**
     * Ce méthode nous permet de modifier une publication en particulier
     * On a besoin juste d'une seule parametre qui est l'id du publication 
     * à modifier
     * @param string $acceuilId Récuperation de l'id de la publication dans l'url
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(string $acceuilId)
    {
        $acceuilInterface = AcceuilInterface::findOrFail($acceuilId);
        return view($this->viewPath().'action.random', [
            'acceuilInterface' => $acceuilInterface
        ]);
    }

    
    /**
     * Cette méthode nous permets de sauvgarder les informations modifier
     * dans la vue, Cette partie du code peut-être améliorable et il reste encore la suppréssion
     * de l'image dans le stockage, Ou en peut recuperer les filtrer et les étudier
     * @param \App\Http\Requests\AcceuilInterfaceMajRequest $acceuilInterfaceMajRequest
     * @param string $acceuilId
     * @return RedirectResponse
     */
    public function update(AcceuilInterfaceMajRequest $acceuilInterfaceMajRequest, string $acceuilId): RedirectResponse
    {
        /** @var array $data Récuperation des données valider dans data */
        $data = $acceuilInterfaceMajRequest->validated();
        //Récuperation de la publication à modifier
        $acceuilInterface = AcceuilInterface::findOrFail($acceuilId);
        //verifie si les information sont erroner
        $status = $acceuilInterfaceMajRequest->validated('status');
        if($status !== '0' && $status !== '1') {
            return redirect()->route($this->routes().'edit', ['acceuilId' => $acceuilInterface->id])->with('error','Une erreur c\'est survenu lors de la modification');
        }
        try {
            //mettre à Jours la publication
            $acceuilInterface->update($data);
            //verifier si l'utilisateur a importer une photo
            $image = $acceuilInterfaceMajRequest->validated('image');
            if(!empty($image)) {
                $pic['picture'] = $image->store('acceuil_interface', 'public');
                $acceuilInterface->update($pic);
            }
            
            return redirect()->route($this->routes().'edit', ['acceuilId' => $acceuilInterface->id])->with('success','Mis à jour réussi');
        } catch (\Exception $e) {
            return redirect()->route($this->routes().'edit', ['acceuilId' => $acceuilInterface->id])->with('error','Il y a eu une erreur lors du mis à jour:'.$e->getMessage());
        }
    }

    
    /**
     * Cette méthode permet à l'application de suprimer la publication
     * dans l'administration. Pour éviter divers erreur surtous lors de fausse 
     * manipulation, Cette méthode ne suprimer pas directement la publication mais 
     * le masque seulement pour l'utilisateur
     * @param string $acceuilId
     * @return RedirectResponse
     */
    public function destroy(string $acceuilId)
    {
        $acceuilInterface = AcceuilInterface::findOrFail($acceuilId);
        try {
            /** @var array $supression Mettre suprimer à 1 */
            $supression = [
                'suprimer' => '1'
            ];
            $acceuilInterface->update($supression);
            return redirect()->route($this->routes().'index')->with('success','Supréssion réussi');
        } catch (\Exception $e) {
            return redirect()->route($this->routes().'index')->with('error','Echec de la supréssion'. $e->getMessage());
        }
    }


    /**
     * Nous permet d'avoir le chemin de vue dans
     * une méthode priver et facile à appeler
     * @return string
     */
    private function viewPath(): string 
    {
        return "super-admin.interface-visuel.acceuil.";
    }

    /**
     * Nous permet d'avoir le nom de route stocker 
     * dynamiquement dans une variable
     * @return string
     */
    private function routes(): string 
    {
        return "Connected.GestionDuSite.InterfaceVisuel.Acceuil.";
    }
}
