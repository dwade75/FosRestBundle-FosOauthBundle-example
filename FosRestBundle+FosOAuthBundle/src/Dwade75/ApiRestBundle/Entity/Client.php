<?php

    namespace Dwade75\ApiRestBundle\Entity;

    use FOS\OAuthServerBundle\Entity\Client as BaseClient;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity
     */
    class Client extends BaseClient
    {
        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;

        /**
         * @ORM\OneToOne(targetEntity="Dwade75\ApiRestBundle\Entity\FosUser", inversedBy="client")
         */
        private $fosUser;

        public function __construct()
        {
            parent::__construct();
            // your own logic
        }

        /**
         * Set fosUser
         *
         * @param \Dwade75\ApiRestBundle\Entity\FosUser $fosUser
         *
         * @return Client
         */
        public function setFosUser(\Dwade75\ApiRestBundle\Entity\FosUser $fosUser = null)
        {
            $this->fosUser = $fosUser;

            return $this;
        }

        /**
         * Get fosUser
         *
         * @return \Dwade75\ApiRestBundle\Entity\FosUser
         */
        public function getFosUser()
        {
            return $this->fosUser;
        }
    }
