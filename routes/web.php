<?php

use App\Http\Controllers\AcceuilInterfaceControlleur;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\CompteManagementController;
use App\Http\Controllers\ListeDeNosEmployerController;
use App\Http\Controllers\MessageRecuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileSuperAdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Routes incremented in laravel breeze
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/
require __DIR__.'/auth.php';

//Public routes
Route::prefix('/')->name('Public.')->group( function () {
    //interface
    Route::get('/', [SiteController::class, 'interface'])->name('interface');
    //Forum
    Route::get('/forum', [SiteController::class, 'forum'])->name('forum');
    //cours
    Route::get('/Nos-cours', [SiteController::class, 'cours'])->name('cours');
    //contact
    Route::prefix('/nous-contacter')->name('Contact.')->group( function () {
        Route::get('/', [SiteController::class, 'contact'])->name('index');
        Route::post('/Envoye', [MessageRecuController::class, 'send'])->name('send');
    });
    
    //evenement
    Route::get('/Nos-evenement', [SiteController::class, 'evenement'])->name('evenement');
    //Propos
    Route::get('/Nos-propos', [SiteController::class, 'propos'])->name('propos');
});

//Connected routes
Route::prefix('/Connected')->name('Connected.')->middleware(['auth', 'verified'])->group( function () {
    //Administration
    Route::prefix('/Administration')->name('Administration.')->group( function () {
        Route::get('/', [AdministrationController::class, 'index'])->name('index');
    });
    //fin des routes pour l'administration


    //Super Admin
    Route::prefix('/Super-Admin')->name('SuperAdmin.')->group( function () {
        Route::get('/', [SuperAdminController::class, 'index'])->name('index');
        /* 
            Route pour la gestion des comptes et rôle
        */
        Route::prefix('/Gestion-des-comptes')->name('CompteManagement.')->group( function () {
            //gestion des comptes
            Route::prefix('/Compte')->name('Compte.')->group( function () {
                //recuperation des utilisateurs
                Route::get('/', [CompteManagementController::class, 'listing'])->name('listing');
                //Edition sur un utilisateur a modifier
                Route::get('/a58-6{userId}7-55', [CompteManagementController::class, 'edit'])->name('edit');
                //Sauvgarde des informations modifier
                Route::put('/a58-6{userId}7-55', [CompteManagementController::class, 'update'])->name('update');
                //supression d'un utilisateur
                Route::delete('/Suppréssion/6{userId}754', [CompteManagementController::class, 'delete'])->name('delete');
            }); 
            //gestion des rôles
            Route::prefix('/Role')->name('Role.')->group( function () {
                //Lister tous les rôle disponible
                Route::get('/', [RoleController::class, 'listing'])->name('listing');
                //création d'un rôle en particulier
                Route::get('/Création', [RoleController::class, 'create'])->name('create');
                Route::post('/Création', [RoleController::class, 'store'])->name('store');
                //edition
                Route::get('/5{roleId}6-edition', [RoleController::class, 'edit'])->name('edit');
                Route::put('/5{roleId}6-edition', [RoleController::class, 'update'])->name('update');
            });
        });
        /*
            Route pour la gestion des profiles cotés super administrateur , modérateur (profésseur) et étudiant 
        */
        Route::prefix('/Gestion-de-profile')->name('Profile.')->group( function () {
            //Gestion de profile pour les Super-Administrateur
            Route::prefix('/Super')->name('SuperAdmin.')->group( function (){
                //Renvoye le super admin vers l'edition de ses informations
                Route::get('/Mon-profil', [ProfileSuperAdminController::class, 'profile'])->name('profile');
                //Renvoye vers les parametres du compte
                Route::get('/Parametre-du-compte', [ProfileSuperAdminController::class, 'setting'])->name('setting');
                //Supression du compte de l'utilisateur
                Route::delete('/Suppression-du-compte',[ProfileSuperAdminController::class, 'destroy'])->name('destroy');
                //Renvoye vers la vue d'édition des informations personnelle de l'utilisateur
                Route::get('/Edition-de-mon-profile',[ProfileSuperAdminController::class, 'editInformation'])->name('editInformation');
                //Mis a jours
                Route::put('/Edition-de-mon-profile',[ProfileSuperAdminController::class, 'updateInformation'])->name('updateInformation');
                //Vue pour changer les mots de passe
                Route::get('/modification-de-vos-information-personnel',[ProfileSuperAdminController::class, 'passwordUpdate'])->name('passwordUpdate');
            });
        });
    });
    //Fin des routes pour la super admin

    //Service Client
    Route::prefix('/Service-client')->name('ServiceClient.')->group( function () {
        //message reçu
        Route::prefix('/Liste-des-message-recu')->name('MessageRecu.')->group( function () {
            //Route qui liste tous les message
            route::get('/', [MessageRecuController::class, 'tousLesMessage'])->name('tousLesMessage');
            //Route sur une message en particulier
            route::get('/sz-{messageId}797', [MessageRecuController::class, 'vueSurUneMessage'])->name('vueSurUneMessage');
        });
    });
    //fin des routes pour le service client


    //Route pour les gestions du site
    Route::prefix('/Gestion-de-notre-application')->name('GestionDuSite.')->group( function () {
        //pour l'interface visuel
        Route::prefix('/Interface-visuel')->name('InterfaceVisuel.')->group( function () {
            //pour l'acceuil
            Route::prefix('/Acceuil')->name('Acceuil.')->group( function () {
                //lister les publication
                Route::get('/', [AcceuilInterfaceControlleur::class, 'index'])->name('index');
                //route pour creer une publication
                Route::get('/creation-d-une-publication', [AcceuilInterfaceControlleur::class, 'create'])->name('create');
                Route::post('/creation-d-une-publication', [AcceuilInterfaceControlleur::class, 'store'])->name('store');
                //route pour l'edition d'une publication
                Route::get('/edition-d-une-publication/z87-{acceuilId}78s-735', [AcceuilInterfaceControlleur::class, 'edit'])->name('edit');
                Route::put('/edition-d-une-publication/z87-{acceuilId}78s-735', [AcceuilInterfaceControlleur::class, 'update'])->name('update');
                //route pour suprimer une publication
                route::delete('/supression-d-une-publication/z98-6{acceuilId}5s-732', [AcceuilInterfaceControlleur::class, 'destroy'])->name('destroy');
            });
            //fin de route pour l'acceuil 
        });
        //Route pour la liste de nos employer
        Route::prefix('/Liste-de-nos-employer')->name('ListeDeNosEmployer.')->group( function () {
            Route::get('/', [ListeDeNosEmployerController::class, 'liste'])->name('liste');
        });
        //fin de route pour la liste de nos employer
    });
    //fin des route pour la gestions du site

});