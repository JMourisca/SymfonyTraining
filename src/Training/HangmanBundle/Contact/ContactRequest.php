<?php
/**
 * Created by PhpStorm.
 * User: juliana
 * Date: 21/09/16
 * Time: 09:45
 */

namespace Training\HangmanBundle\Contact;

use Symfony\Component\Validator\Constraints as Assert;


class ContactRequest
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email(message="{{ value }} is not valid")
     */
    public $sender;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=64)
     */
    public $subject;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $message;
}