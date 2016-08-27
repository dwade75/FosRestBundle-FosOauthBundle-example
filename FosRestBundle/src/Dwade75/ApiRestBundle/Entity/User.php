<?php


    namespace Dwade75\ApiRestBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * @ORM\Entity()
     * @ORM\Table(name="users",
     *      uniqueConstraints={@ORM\UniqueConstraint(name="users_email_unique",columns={"email"})}
     * )
     */
    class User
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
        protected $firstname;

        /**
         * @ORM\Column(type="string")
         * @Assert\NotBlank()
         */
        protected $lastname;

        /**
         * @ORM\Column(type="string")
         * @Assert\NotBlank()
         */
        protected $email;

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getFirstname()
        {
            return $this->firstname;
        }

        public function setFirstname($firstname)
        {
            $this->firstname = $firstname;
        }

        public function getLastname()
        {
            return $this->lastname;
        }

        public function setLastname($lastname)
        {
            $this->lastname = $lastname;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }
    }