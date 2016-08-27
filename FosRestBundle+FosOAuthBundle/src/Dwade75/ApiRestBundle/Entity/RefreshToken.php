<?php

    namespace Dwade75\ApiRestBundle\Entity;


    use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity
     */
    class RefreshToken extends BaseRefreshToken
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