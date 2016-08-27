<?php

    namespace Dwade75\ApiRestBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Security\Core\Exception\AccessDeniedException;

    class AdminController extends Controller
    {
        public function adminAction()
        {
            if (false === $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                throw new AccessDeniedException();
            }

            $user = $this->getUser();

            if($user->getClient() === null) {
                //Permet de generer une cle publique et une cle privee dans la table client
                $clientManager = $this->get('fos_oauth_server.client_manager.default');
                $client = $clientManager->createClient();
                //$client->setRedirectUris(array('http://www.example.com'));
                $client->setAllowedGrantTypes(array('password'));
                $client->setFosUser($user);
                $clientManager->updateClient($client);
               return  $this->redirect($this->generateUrl('dwade75_admin_homepage'));

            }

            return $this->render('Dwade75ApiRestBundle:Default:admin.html.twig', array('apiKey' => $user->getClient()));

        }
    }
