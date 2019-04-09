<?php
/**
 * Created by PhpStorm.
 * User: tongguillaume
 * Date: 2019-04-09
 * Time: 10:41
 */

namespace App\Controller;


use App\Entity\Matiere;
use App\Entity\Notes;
use App\Form\NoteFormType;
use App\Utils\moyenne;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NotesController extends AbstractController
{
    /**
     * @Route("/notes", name="note_list")
     */
    public function notelist(ObjectManager $em, Request $request)
    {
        $user = $this->getUser();
        $listmatiere = $em->getRepository(Matiere::class)->listmatiere();
        $listnote = $em->getRepository(Notes::class)->listnote($user->getId());
        $lenght = $em->getRepository(Matiere::class)->countlistmoyenne();

        $array_moyenne = moyenne::arraymoyenne($listnote, $lenght);
        $moyenne_general = moyenne::moyenneofmatter($array_moyenne, $listmatiere, $lenght);

        return $this->render('note/list.html.twig', [
            'listmatiere' => $listmatiere,
            'listnote' => $listnote,
            'listmoyenne' => $array_moyenne,
            'moyenne' => $moyenne_general
        ]);
    }

    /**
     * @Route("/ajout-note", name="add_note")
     */
    public function noteadd(ObjectManager $em, Notes $note = null, Request $request)
    {
        $new = 0;

        if (!$note) {
            $note = new Notes();
            $new = 1;
        }


        $form = $this->createForm(NoteFormType::class , $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($note);
            $em->flush();
            return $this->redirectToRoute('note_list');
        }

        return $this->render('note/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}