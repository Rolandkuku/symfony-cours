<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Tag;
use AppBundle\Form\TagType;

/**
 * @Route("/tag")
 */
class TagController extends Controller
{
    /**
     * @Route("/", name="tag_index")
     * @Method({"GET"})
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository("AppBundle:Tag")->findAll();

        return $this->render("tag/index.html.twig", [
            "tags" => $tags
        ]);
    }

    /**
     *  Creates an tag
     *  @Route("/create", name="tag_create")
     *  @Method({"GET", "POST"})
     *  @return void
     */
    public function createAction(Request $request) {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            $this->addFlash(`success`, `L'tag {$tag->getName()} a été créé!`);

            return $this->redirectToRoute('tag_show', ["slug" => $tag->getSlug()]);
        }

        return $this->render('tag/create.html.twig', [
            'tag' => $tag,
            'form' => $form->createView()
        ]);
    }

     /**
     *  Updates an tag
     *  @Route("/{slug}/update", name="tag_update")
     *  @Method({"GET", "POST"})
     *  @return void
     */
    public function updateAction(Request $request, Tag $tag) {
        $em = $this->getDoctrine()->getManager();

        $tag = $em->getRepository("AppBundle:Tag")->find($tag);
        $form = $this->createForm(TagType::class, $tag);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash(`success`, `L'tag {$tag->getName()} a été modifié !`);

            return $this->redirectToRoute('tag_show', ["slug" => $tag->getSlug()]);
        }

        return $this->render('tag/create.html.twig', [
            'tag' => $tag,
            'form' => $form->createView()
        ]);
    }

    /**
     * Shows an tag
     * @Route("/{slug}", name="tag_show")
     * @Method({"GET"})
     * @param Tag $tag
     * @return response
     */
    public function showAction(Request $req, Tag $tag) {
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository("AppBundle:Tag")->find($tag);

        return $this->render("tag/show.html.twig", [
            "tag" => $tag
        ]);
    }

    /**
     * Deletes an tag
     * @Route("/delete/{slug}/token", name="tag_delete")
     * @Method({"GET"})
     * @param Request $request
     * @param Tag $tag
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Tag $tag) {
        $token = $request->attributes->get("token");

        if($this->isCsrfTokenValid("delete_tag", $token)) {
            throw new AccessDeniedException("Erreur CSRF");
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($tag);
        $em->flush();

        return $this->redirectToRoute("tag_index");
    }
}
