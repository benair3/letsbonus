<?php
// src/AppBundle/Controller/DefaultController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Form\PostType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     *
     *  @param Request $request
         *
         * @return RedirectResponse
     */
    public function newAction(Request $request)
    {


        $post = new Post();
        $form = $this->createForm(new PostType(), $post);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$post->upload();
            $em->persist($post);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Thank you!'
            );
        }
        return $this->render('default/index.html.twig', array(
            'form' => $form->createView(),
        ));


    }
}
