<?php

    namespace Dwade75\ApiRestBundle\Controller;

    use Dwade75\ApiRestBundle\Entity\User;
    use Dwade75\ApiRestBundle\Form\Type\UserFormType;
    use FOS\RestBundle\View\View;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use FOS\RestBundle\Controller\Annotations as Rest;

    class UserController extends Controller
    {
        /**
         * @Rest\View()
         * @Rest\Get("/users")
         */
        public function getUsersAction()
        {
            $users = $this->get('doctrine.orm.entity_manager')
                ->getRepository('Dwade75ApiRestBundle:User')
                ->findAll();

            return $users;
        }

        /**
         * @Rest\View()
         * @Rest\Get("/user/{id}")
         */
        public function getUserAction($id)
        {
            $user = $this->get('doctrine.orm.entity_manager')
                ->getRepository('Dwade75ApiRestBundle:User')
                ->find($id);

            if (empty($user)) {
                return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
            }

            return $user;
        }

        /**
         * @Rest\View(statusCode=Response::HTTP_CREATED)
         * @Rest\Post("/users")
         */
        public function postUsersAction(Request $request)
        {
            $user = new User();
            $form = $this->createForm(UserFormType::class, $user);
            $form->submit($request->request->all());

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                return $user;
            } else {
                return $form;
            }
        }

        /**
         * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
         * @Rest\Delete("/users/{id}")
         */
        public function deleteUserAction(Request $request)
        {
            $em = $this->get('doctrine.orm.entity_manager');
            $user = $em->getRepository('AppBundle:User')
                ->find($request->get('id'));
            /* @var $user User */

            if ($user) {
                $em->remove($user);
                $em->flush();
            }
        }

        /**
         * @Rest\View()
         * @Rest\Put("/users/{id}")
         */
        public function putUserAction($id, Request $request)
        {
            $user = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:User')
                ->find($id); // L'identifiant en tant que paramètre n'est plus nécessaire

            if (empty($user)) {
                return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
            }

            $form = $this->createForm(UserFormType::class, $user);

            $form->submit($request->request->all());

            if ($form->isValid()) {
                $em = $this->get('doctrine.orm.entity_manager');
                $em->merge($user);
                $em->flush();
                return $user;
            } else {
                return $form;
            }
        }

        /**
         * @Rest\View()
         * @Rest\Patch("/users/{id}")
         */
        public function patchUserAction($id, Request $request)
        {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('Dwade75ApiRestBundle:User')->find($id);

            if (empty($user)) {
                return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
            }

            $form = $this->createForm(UserFormType::class, $user);
            $form->submit($request->request->all(), false);

            if($form->isValid()) {
                $em->merge($user);
                $em->flush();
                return $user;
            } else {
                return $form;
            }
        }
    }
