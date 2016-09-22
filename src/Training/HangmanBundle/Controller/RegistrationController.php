<?php
/**
 * Created by PhpStorm.
 * User: juliana
 * Date: 22/09/16
 * Time: 11:05
 */

namespace Training\HangmanBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Training\HangmanBundle\Form\RegistrationType;
use Training\HangmanBundle\Entity\Player;

class RegistrationController extends Controller
{
    /**
     * @Route(path="/register", name="hangman_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $player = new Player();
        $form = $this->createForm(RegistrationType::class, $player);
        $form->add('register', SubmitType::class);
        $form->handleRequest($request);

        if($form->isValid())
        {
            // TODO: Put all this in a service and call RegisterUser($player) to register the user
            $encoder = $this->get('security.password_encoder');

            $password = $encoder->encodePassword(
                $player,
                $player->rawPassword
            );

            $player->setPassword($password);

            $em = $this->getDoctrine()->getManagerForClass(Player::class); //creates the transaction
            $em->persist($player);
            $em->flush(); //writes the player to the database

            return $this->redirectToRoute('hangman_play');
        }

        return $this->render(
            '@TrainingHangman/registration/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );

    }

}