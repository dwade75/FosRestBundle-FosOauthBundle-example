<?php
    namespace Dwade75\ApiRestBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * @ORM\Entity()
     * @ORM\Table(name="places",
     *      uniqueConstraints={@ORM\UniqueConstraint(name="places_name_unique",columns={"name"})}
     * )
     */
    class Place
    {
        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue
         */
        protected $id;

        /**
         * @ORM\Column(type="string")
         * @Assert\NotBlank()
         */
        protected $name;

        /**
         * @ORM\Column(type="string")
         * @Assert\NotBlank()
         */
        protected $address;

        public function getId()
        {
            return $this->id;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getAddress()
        {
            return $this->address;
        }

        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }

        public function setName($name)
        {
            $this->name = $name;
            return $this;
        }

        public function setAddress($address)
        {
            $this->address = $address;
            return $this;
        }
    }