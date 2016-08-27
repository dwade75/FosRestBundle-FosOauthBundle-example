<?php
    /**
     * Date: 20/08/2016
     * Time: 10:37
     */

    namespace Dwade75\ApiRestBundle\Entity;


    use FOS\OAuthServerBundle\Entity\AuthCode as BaseAuthCode;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity
     */
    class AuthCode extends BaseAuthCode
    {
        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;

        /**
         * @ORM\ManyToOne(targetEntity="Dwade75\ApiRestBundle\Entity\Client")
         * @ORM\JoinColumn(nullable=false)
         */
        protected $client;

        /**
         * @ORM\ManyToOne(targetEntity="Dwade75\ApiRestBundle\Entity\FosUser")
         */
        protected $user;
    }