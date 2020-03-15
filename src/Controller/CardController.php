<?php

namespace App\Controller;

use App\Repository\FactionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// Entities
use App\Entity\Card;
use App\Form\FormCardType;
use  App\Entity\User;
use App\Form\RegistrationFormType;
use App\Entity\Faction;
use App\Form\FactionFormType;
use App\Repository\CardRepository;


class CardController extends AbstractController
{
    public function index()
    {
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
        ]);
    }

    /**
     * @Route("/listCard", name="card_list", methods={"GET"})
     */
    public function listAll(CardRepository $cardRepository): Response
    {
        return $this->render('card/list.html.twig', [
            'cards' => $cardRepository->findAll(),
        ]);
    }

    /**
     * @Route("/card", name="card")
     */
    public function card(Request $request)
    {
        $em =$this->getDoctrine()->getManager();
        $card = new Card();
        $formCard = $this->createForm(FormCardType::class, $card);
        $cards = $em ->getRepository(Card::class)->findAll();
        $formCard->handleRequest($request);

        if($formCard->isSubmitted()&& $formCard->isValid() ) {
            $card->setMaker($this->getUser());
            $image = $formCard->get('image')->getData();
            $imageName = 'card-'.uniqid().'.'.$image->guessExtension();
            $image->move(
                $this->getParameter('cards_folder'),
                $imageName
            );
            $card->setImage($imageName);

            $em->persist($card);
            $em->flush();

        }
        return $this->render('card/index.html.twig', [
            'Card' => $cards,
            'formCard' => $formCard->createView(),
        ]);
    }

    /**
     * @Route("/listFaction", name="faction_list", methods={"GET"})
     */
    public function listAllFaction(FactionRepository $factionRepository): Response
    {
        return $this->render('faction/list.html.twig', [
            'factions' => $factionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/faction", name="faction")
     */
    public function faction(Request $request)
    {
        $em =$this->getDoctrine()->getManager();

        $faction =  new Faction();
        $formFaction = $this-> createForm(FactionFormType::class, $faction);
        $factions = $em ->getRepository(Faction::class)->findAll();
        $formFaction->handleRequest($request);
        if($formFaction->isSubmitted() && $formFaction->isValid()) {
            $em->persist($faction);
            $em->flush();
            return new Response($faction->getName().' created');
        }
        return $this->render('faction/index.html.twig', [
            'entities' => $factions,
            'form' => $formFaction ->createView()
        ]);
    }
}

