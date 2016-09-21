<?php
/**
 * Created by PhpStorm.
 * User: juliana
 * Date: 21/09/16
 * Time: 09:57
 */

namespace Training\HangmanBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Training\HangmanBundle\Contact\ContactRequest;
use Training\HangmanBundle\Form\ContactType;

class ContactController extends Controller
{
    /**
     * @Route(path="/contact", name="hangman_contact")
     */
    public function indexAction(Request $request) {
        $contactRequest = new ContactRequest();
        $form = $this->createForm(ContactType::class, $contactRequest);
        $form->add('send', SubmitType::class);

        $form->handleRequest($request);

        if($form->isValid()) {
            // Do stuff

            return $this->redirectToRoute('hangman_play');
        }

        return $this->render('@TrainingHangman/contact/index.html.twig',
            [
                'form' => $form->createView()
            ]);
    }
}