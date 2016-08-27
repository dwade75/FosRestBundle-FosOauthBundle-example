<?php

    namespace Dwade75\ApiRestBundle\Entity;


    use Doctrine\ORM\Mapping as ORM;
    use FOS\OAuthServerBundle\Entity\AccessToken as BaseAccessToken;

    /**
     * @ORM\Entity
     */
    class AccessToken extends BaseAccessToken
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