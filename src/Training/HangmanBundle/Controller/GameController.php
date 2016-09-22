<?php
/**
 * Created by PhpStorm.
 * User: juliana
 * Date: 20/09/16
 * Time: 14:07
 */

namespace Training\HangmanBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Training\HangmanBundle\Game\GameContext;
use Training\HangmanBundle\Game\GameRunner;
use Training\HangmanBundle\Game\WordList;

/**
 * @Route(path="/game")
 */
class GameController extends Controller
{
    /**
     * @Route(path="/", name="hangman_play")
     */
    public function playAction ()
    {
        $game = $this->getGameRunner()->loadGame();

        if($game->isWon()) {
            return $this->redirectToRoute('hangman_won');
        }

        if($game->isHanged()) {
            return $this->redirectToRoute('hangman_lost');
        }

        //dump($game);

        return $this->render('@TrainingHangman/game/play.html.twig',
            [
                'game' => $game
            ]);
    }

    /**
     * @Route(path="/letter/{letter}", name="hangman_play_letter")
     */
    public function playLetterAction($letter)
    {
        $this->getGameRunner()->playLetter($letter);

        return $this->redirectToRoute('hangman_play');
    }

    /**
     * @Route(path="/reset", name="hangman_reset")
     */
    public function resetGameAction() {
        $this->getGameRunner()->resetGame();
        return $this->redirectToRoute('hangman_play');
    }

    /**
     * @Route(path="/won", name="hangman_won")
     */
    public function wonAction() {
        $game = $this->getGameRunner()->resetGameOnSuccess();

        return $this->render('@TrainingHangman/game/won.html.twig',
            [
                'game' => $game
            ]);
    }

    /**
     * @Route(path="/lost", name="hangman_lost")
     */
    public function lostAction() {
        $game = $this->getGameRunner()->resetGameOnFailure();

        return $this->render('@TrainingHangman/game/lost.html.twig',
            [
                'game' => $game
            ]);
    }

    private function getGameRunner()
    {
        return $this->get('hangman.game_runner');
    }
}