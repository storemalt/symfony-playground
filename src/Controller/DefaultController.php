<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(): Response
    {
        return $this->render('index.html.twig', ['myCoolVariable' => 'Yay! It works.']);
    }

    public function hello(Request $request, string $name): Response
    {
        $lastName = $request->get('lastName', 'noName');
        return $this->render('hello.html.twig', ['firstName' => $name, 'lastName' => $lastName]);
    }

    public function createPost(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if (false === $form->isSubmitted() || false === $form->isValid()) {
            return $this->render('create.html.twig', ['form' => $form->createView()]);
        }

        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return $this->redirect('create');
    }

    public function listPosts(Request $request): Response
    {
        $query = '%'.$request->get('title', '').'%';

        $posts = $this->entityManager->createQueryBuilder()
            ->select('post')
            ->from(Post::class, 'post')
            ->where('post.title like :query')
            ->setParameter('query', $query)
            ->getQuery()
            ->getResult()
        ;

        return $this->render('list.html.twig', ['posts' => $posts]);
    }
}
