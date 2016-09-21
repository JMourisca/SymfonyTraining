<?php
/**
 * Created by PhpStorm.
 * User: juliana
 * Date: 21/09/16
 * Time: 16:31
 */

namespace Training\HangmanBundle\Game;


use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GameContextTest extends \PHPUnit_Framework_TestCase
{
    public function testNewGameReturnGame()
    {
        $session = $this->createMock(SessionInterface::class); // after upgrade stuff
        $context = new GameContext($session);

        $this->assertInstanceOf(Game::class, $context->newGame('php'));
    }

    public function testLoadGame()
    {
        $session = $this->createMock(SessionInterface::class);
        $session
            ->expects($this->once())
            ->method('get')
            ->with('hangman')
            ->willReturn([
                'word'          => 'php',
                'attempts'      => 0,
                'tried_letters' => [],
                'found_letters' => []
            ]);

        $context = new GameContext($session);
        $game = $context->loadGame();

        $this->assertEquals('php', $game->getWord());
    }
}