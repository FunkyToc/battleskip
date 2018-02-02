<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

use App\Game\Characters\CharacterFactory;



class HomeController extends Controller 
{

    /**
     * @Route("/", name="battleskip")
     */
    public function index()
    {
        return $this->render('home.html.twig');
    }


    /**
     * @Route("/play/", name="battleskip_play")
     */
    public function play()
    {

        $FactoryManager = new CharacterFactory();

        $warriorFactory     = $FactoryManager->create('warrior');
        $archerFactory      = $FactoryManager->create('archer');
        $mageFactory        = $FactoryManager->create('mage');

        $player1 = $warriorFactory->create();
        $player2 = $archerFactory->create();
        $player3 = $mageFactory->create();



        dump($player1);
        dump($player2);
        dump($player3);
        die;

        return $this->render('play.html.twig', ['player1' => $player1, 'player2' => $player2]);
    }

}