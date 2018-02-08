<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\BattleForm;

use App\Game\Characters\CharacterFactory;
use App\Game\Army\Army;
use App\Game\Combat\CombatManager;


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

        $battleForm = $this->createFormBuilder($battleForm)
            ->add('p1_warrior', NumberType::class, ['attr' => ['type' => 'number', 'min' => 0, 'max' => 50]])
            ->add('p1_archer', NumberType::class, ['attr' => ['type' => 'number', 'min' => 0, 'max' => 50]])
            ->add('p1_mage', NumberType::class, ['attr' => ['type' => 'number', 'min' => 0, 'max' => 50]])
            ->add('p2_warrior', NumberType::class, ['attr' => ['type' => 'number', 'min' => 0, 'max' => 50]])
            ->add('p2_archer', NumberType::class, ['attr' => ['type' => 'number', 'min' => 0, 'max' => 50]])
            ->add('p2_mage', NumberType::class, ['attr' => ['type' => 'number', 'min' => 0, 'max' => 50]])
            ->add('Battle !', SubmitType::class, ['attr' => ['type' => 'number', 'min' => 0, 'max' => 50]])
            ->getForm();
        $battleForm->handleRequest($request);

        // Start Game 
        if ($battleForm->isSubmitted() && $battleForm->isValid()) 
        {
            // Characters Factories 
            $FactoryManager     = new CharacterFactory();
            $warriorFactory     = $FactoryManager->create('warrior');
            $archerFactory      = $FactoryManager->create('archer');
            $mageFactory        = $FactoryManager->create('mage');
            
            // Armies (collection) 
            $army1 = new Army(array_merge($warriorFactory->createMany($battleForm->getData()->p1_warrior), $archerFactory->createMany($battleForm->getData()->p1_archer), $mageFactory->createMany($battleForm->getData()->p1_mage)));
            $army2 = new Army(array_merge($warriorFactory->createMany($battleForm->getData()->p2_warrior), $archerFactory->createMany($battleForm->getData()->p2_archer), $mageFactory->createMany($battleForm->getData()->p2_mage)));

            // Combat 
            $combatManager = new CombatManager($army1, $army2);
            $combatManager->fight();
    

            //dump($army1);
            //dump($army2);
            //dump($combatManager->getArmy2()->getUnitsList());
            //dump($combatManager->getUnitsTurn()[1]['army1']->getUnitsList());
            //dump($combatManager->getUnitsTurn()[2]['army1']->getUnitsList());
            //die;

            return $this->render('play.html.twig', ['battleForm' => $battleForm->createView(), 'combat' => $combatManager]);
        }
 
        return $this->render('play.html.twig', ['battleForm' => $battleForm->createView()]);
    }

}