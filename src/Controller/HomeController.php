<?php

namespace App\Controller;

use App\Entity\Simulation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    //Simulation avec les données
    #[Route('/api/checksimulation', name:"checkSimulation", methods:['POST'])]
    public function simulation(Request $request) {
        $data = json_decode($request->getContent());
        $user = $data[0];
        $voiture = $data[1];
        $cout = $this->calculDevisParCritere($user, $voiture);
        return $this->json(json_encode($cout));
    }
    
    //Ajout de la simulation en base de données
    #[Route('/api/addsimulation', name:"addSimulation", methods:['POST'])]
    public function addsimulation(Request $request, ManagerRegistry $doctrine) {
        $data = json_decode($request->getContent());
        $user = $data[0];
        $voiture = $data[1];
        $cout = $data[2];

        //Création et hydratation de l'objet
        $entityManager = $doctrine->getManager();
        $simulation = new Simulation();
        $simulation->setNom($user->nom);
        $simulation->setPrenom($user->prenom);
        $simulation->setAgeUser((int)$user->agePro);
        $simulation->setPuissanceFiscale((int)$voiture->pf);
        $simulation->setAgeVehicule((int)$voiture->pf);
        $simulation->setMarque($voiture->marque);
        $simulation->setModele((int)$voiture->modele);
        $simulation->setCout((int)$cout);
        $simulation->setCritereAgeUser((int)$user->agePro);
        $simulation->setCritereModelVoiture((int)$voiture->modele);
        //Enregistrement des informations en base de données
        $entityManager->persist($simulation);
        $entityManager->flush();

        return $this->json(['code' => 204]);
    }


    //Fonction permettant de calculer selon l'âge du propriétaire et le modèle de la voiture
    private function calculDevisParCritere($user, $voiture) : int {

        $multiplicateur = 0;
        $agePropriétaire = (int)$user->agePro;
        $modeleVoiture = (int)$voiture->modele;

        //Multiplicateur selon l'age du propriétaire de la voiture
        if($agePropriétaire >= 21 || $agePropriétaire <= 35){
            $multiplicateur = 2.5; 
        }
        if($agePropriétaire > 35 || $agePropriétaire <= 45){
            $multiplicateur = 2;
        }
        if($agePropriétaire > 45 || $agePropriétaire <= 65){
            $multiplicateur = 1.5;
        }
        if($agePropriétaire > 65 ){
            $multiplicateur = 1;
        }

        //Multiplicateur selon le modèle de la voiture
        switch ($modeleVoiture) {
            case 1:
                $multiplicateur = $multiplicateur +3; 
                break;
            case 2:
                $multiplicateur = $multiplicateur +2; 
                break;
            case 3:
                $multiplicateur = $multiplicateur +3.5; 
                break;
            case 4:
                $multiplicateur = $multiplicateur +4; 
                break;

        }

        //Cout de la simulation selon les critères
        $coutDassuranceBase = (int)$this->getParameter('app.assurance_base'); //Cout d'assurance de base
        
        return $coutDassuranceBase*$multiplicateur;
    }
}
