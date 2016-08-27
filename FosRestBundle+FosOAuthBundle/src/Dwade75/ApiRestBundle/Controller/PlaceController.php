<?php

    namespace Dwade75\ApiRestBundle\Controller;


    use Dwade75\ApiRestBundle\Entity\Place;
    use Dwade75\ApiRestBundle\Form\Type\PlaceFormType;
    use FOS\RestBundle\View\View;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use FOS\RestBundle\Controller\Annotations as Rest;
    use Symfony\Component\Security\Core\Exception\AccessDeniedException;


    class PlaceController extends Controller
    {
        /**
         * @Rest\View()
         * @Rest\Get("/places")
         */
        public function getPlacesAction()
        {
            $places = $this->get('doctrine.orm.entity_manager')
                ->getRepository('Dwade75ApiRestBundle:Place')
                ->findAll(array('id' => 'DESC'));

            return $places;
        }

        /**
         * @Rest\View()
         * @Rest\Get("/place/{id}")
         */
        public function getPlaceAction($id)
        {
            $place = $this->get('doctrine.orm.entity_manager')
                ->getRepository('Dwade75ApiRestBundle:Place')
                ->find($id);

            if (empty($place)) {
                return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
            }

            return $place;
        }

        /**
         * @Rest\View(statusCode=Response::HTTP_CREATED)
         * @Rest\Post("/place")
         */
        public function postPlacesAction(Request $request)
        {
            // Interdire l'access sans token
            if (false === $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                throw new AccessDeniedException();
            }

            $place = new Place();
            $form = $this->createForm(PlaceFormType::class, $place);
            $form->submit($request->request->all());

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($place);
                $em->flush();
                return $place;
            } else {
                return $form;
            }
        }

        /**
         * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
         * @Rest\Delete("/place/{id}")
         */
        public function deletePlaceAction($id)
        {
            // Interdire l'access sans token
            if (false === $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                throw new AccessDeniedException();
            }

            $em = $this->getDoctrine()->getManager();
            $place = $em->getRepository('Dwade75ApiRestBundle:Place')->find($id);

            if ($place) {
                $em->remove($place);
                $em->flush();
            }
        }

        /**
         * @Rest\View()
         * @Rest\Put("/place/{id}")
         */
        public function putPlaceAction($id, Request $request)
        {
            // Interdire l'access sans token
            if (false === $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                throw new AccessDeniedException();
            }

            $em = $this->getDoctrine()->getManager();
            $place = $em->getRepository('Dwade75ApiRestBundle:Place')->find($id);

            if (empty($place)) {
                return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
            }

            $form = $this->createForm(PlaceFormType::class, $place);
            $form->submit($request->request->all());

            if ($form->isValid()) {
                $em->merge($place);
                $em->flush();
                return $place;
            } else {
                return $form;
            }
        }

        /**
         * @Rest\View()
         * @Rest\Patch("/place/{id}")
         */
        public function patchPlaceAction($id, Request $request)
        {
            // Interdire l'access sans token
            if (false === $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                throw new AccessDeniedException();
            }

            $em = $this->getDoctrine()->getManager();
            $place = $em->getRepository('Dwade75ApiRestBundle:Place')->find($id);

            if (empty($place)) {
                return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
            }

            $form = $this->createForm(PlaceFormType::class, $place);
            $form->submit($request->request->all(), false);

            if($form->isValid()) {
                $em->merge($place);
                $em->flush();
                return $place;
            } else {
                return $form;
            }
        }
    }