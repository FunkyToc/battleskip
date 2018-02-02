<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\BattleForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
    public function play(Request $request)
    {
        // Form 
        $battleForm = new BattleForm($request);

        $battleform = $this->createFormBuilder($battleForm)
            ->add('p1_warrior', NumberType::class)
            ->add('p1_archer', NumberType::class)
            ->add('p1_mage', NumberType::class)
            ->add('p2_warrior', NumberType::class)
            ->add('p2_archer', NumberType::class)
            ->add('p2_mage', NumberType::class)
            ->getForm();

        $datas = $request->request->get('form');
        //dump($datas); die;


        // Army Factories 
        $FactoryManager     = new CharacterFactory();
        $warriorFactory     = $FactoryManager->create('warrior');
        $archerFactory      = $FactoryManager->create('archer');
        $mageFactory        = $FactoryManager->create('mage');

        // Armies 
        //$armyFactory = new ArmyFactory();
        //$army1 = $armyFactory->setArmy($arrayArmy1);
        //$army2 = $armyFactory->setArmy($arrayArmy2);

        // Combat 
        //$combatManager = new CombatManager();
        //$combatManager->setArmy1($army1);
        //$combatManager->setArmy2($army2);
        //$combatManager->fight();
        
        //$combatManager->getWinner();
        //$combatManager->getResult();



        dump($warriorFactory->createMany(3));
        dump($archerFactory->createMany(4));
        dump($mageFactory->createMany(2));
        die;

        return $this->render('play.html.twig', ['battleform' => $battleform->createView(), 'player1' => $player1, 'player2' => $player2]);
    }

}