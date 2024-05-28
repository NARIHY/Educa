<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRecuRequest;
use App\Models\MessageRecu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Ce controlleur nous permet de recevoir des message 
 * qui relie notre service client et nos client
 * En tout, ce controlleur gèrent les envoies de message 
 * cotés public et les vues des message coté service clients
 * @author NARIHY <maheninarandrianarisoa@gmail.com>
 * @copyright 2023 NARIHY
 */
class MessageRecuController extends Controller
{
    /**
     * Ce méthode nous permets d'envoyer les message des utilisateur
     * et de sauvgarder des messages au service client
     * @param \App\Http\Requests\MessageRecuRequest $messageRecuRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(MessageRecuRequest $messageRecuRequest): RedirectResponse 
    {
        /** @var array $data Récuperation des messages valider */
        $data = $messageRecuRequest->validated();
        try {
            $messageRecu = MessageRecu::create($data);
            return redirect()->route('Public.Contact.index')->with('success', 'Merci de nous avoir contacter');
        } catch (\Exception $e) {
            return redirect()->route('Public.Contact.index')->with('error', 'Il y a eu une erreur lors de l\'envoie du message'. $e->getMessage());
        }
    }

    /**
     * Cette méthode nous permet de lister tous 
     * les message envoyer par les utilisateurs
     * @return \Illuminate\View\View
     */
    public function tousLesMessage (): View 
    {
        //Récupération de tous les message reçu en les paginants de 10 par 10
        $messageRecu = MessageRecu::orderBy('created_at', 'desc')
                                        ->paginate(10); 
        return view($this->viewpath().'message',[
            'messageRecu' => $messageRecu
        ]);
    }

    /**
     * Ce méthode nous permet de voir un message en particulier
     * @param string $messageId
     * @return \Illuminate\View\View
     */
    public function vueSurUneMessage(string $messageId): View 
    {
        //Mettre le message à lù si le message n'est pas encore lù
        $this->mettreMessageALu($messageId);
        $messageRecu = MessageRecu::findOrFail($messageId);
        return view($this->viewpath().'view', [
            'messageRecu' => $messageRecu
        ]);
    }

    /**
     * Méthode priver qui permet d'amoindrir la méthode
     * public vueSurUneMessage. Cette méthode vérifie si
     * un utilisateur à déjàs lù le messsage ou pas, Si
     * un utilisateur à déjaàs lu le message alors, celà ne retourne en 
     * rien si non, celà modifie le message à lù
     * @param string $messageId
     * @return mixed
     */
    private function mettreMessageALu(string $messageId)
    {
        //Récuperer l'utilisateur qui est connecter
        $utilisateur = Auth::user();
        //recehercher la message
        $messageRecu = MessageRecu::findOrFail($messageId);
        if ($messageRecu->status === "0") {
            $data= [
                'status' => "1",
                'lecteur' => $utilisateur->id
            ];
            return $messageRecu->update($data);
        }
        return null;
    }

    /**
     * Retourne le chemin de vue racine des message reçu
     * @return string
     */
    private function viewpath(): string 
    {
        return "super-admin.service-client.message-recu.";
    }
}
