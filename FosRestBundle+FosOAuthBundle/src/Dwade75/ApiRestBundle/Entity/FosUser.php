<?php
    /**
     * Date: 20/08/2016
     * Time: 11:54
     */

    namespace Dwade75\ApiRestBundle\Entity;


    use FOS\UserBundle\Model\User as BaseUser;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity
     * @ORM\Table(name="fos_user")
     */
    class FosUser extends BaseUser
    {
        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;

        /**
         * @ORM\OneToOne(targetEntity="Dwade75\ApiRestBundle\Entity\Client", mappedBy="fosUser")
         */
        private $client;

        public function __construct()
        {
            parent::__construct();
            // your own logic
        }
    
    /**
     * Set client
     *
     * @param \Dwade75\ApiRestBundle\Entity\Client $client
     *
     * @return FosUser
     */
    public function setClient(\Dwade75\ApiRestBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Dwade75\ApiRestBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
