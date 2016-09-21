<?php
/**
 * Created by PhpStorm.
 * User: juliana
 * Date: 21/09/16
 * Time: 15:46
 */

namespace Training\HangmanBundle\Game;


class GameTest extends \PHPUnit_Framework_TestCase
{
    public function testTryCorrectWord()
    {
        $game = new Game('php');
        $game->tryWord('php');

        $this->assertTrue($game->isOver());
        $this->assertTrue($game->isWon());
    }

    public function testTryWrongWord()
    {
        $game = new Game('php');
        $game->tryWord('c');

        $this->assertTrue($game->isOver());
        $this->assertTrue($game->isHanged());
    }

    public function testCorrectLetter()
    {
        $game = new Game('php');
        $game->tryLetter('h');

        $this->assertFalse($game->isOver());
        $this->assertTrue($game->isLetterFound('h'));
        $this->assertContains('h', $game->getTriedLetters());
        $this->assertContains('h', $game->getFoundLetters());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidLetter()
    {
        $game = new Game('php');
        $game->tryLetter(1);
    }

    /**
     * @dataProvider providerWrongLetters
     */
    public function testWrongLetter($letter)
    {
        $game = new Game('php');
        $game->tryLetter($letter);
        $this->assertContains($letter, $game->getTriedLetters());
        $this->assertEquals(Game::MAX_ATTEMPTS - 1, $game->getRemainingAttempts());
    }

    public function providerWrongLetters()
    {
        return [['a'], ['b']];
    }
}