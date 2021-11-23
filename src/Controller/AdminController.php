<?php

namespace App\Controller;

use App\Utils\AbstractClasses\CategoryTreeAdminList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Utils\AbstractClasses\CategoryTreeAbstract;
use App\Utils\AbstractClasses\CategoryTreeAdminOptionList;

/**
 * @Route("/admin")
 */

class AdminController extends AbstractController
{
    /** 
     * @Route("/admin", name="admin_main_page")
     */
    public function index(): Response
    {
        return $this->render('admin/my_profile.html.twig');
    }


     /**
     * @Route("/categories", name="categories")
     */
    public function categories(CategoryTreeAdminList $categories): Response

    {
        $categories->getCategoryList($categories->buildTree());
        return $this->render('admin/categories.html.twig',[
            'categories'=>$categories->categorylist
        ]);
    }


     /**
     * @Route("/videos", name="videos")
     */
    public function videos(): Response
    {
        return $this->render('admin/videos.html.twig');
    }


     /**
     * @Route("/upload_video", name="upload_video")
     */
    public function uploadVideo(): Response
    {
        return $this->render('admin/upload_video.html.twig');
    }



    /**
     * @Route("/users", name="users")
     */
    public function users(): Response
    {
        return $this->render('admin/users.html.twig');
    }

        /**
     * @Route("/edit-category", name="edit_category")
     */
    public function editCategory(): Response
    {
        return $this->render('admin/edit_category.html.twig');
    }

        /**
     * @Route("/delete-category/{id}", name="delete_category")
     */ 
    public function deleteCategory($id): Response    
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        $categories= $entityManager->getRepository(Category::class)->find($id);
        $entityManager->remove($categories);
        $entityManager->flush();
        return $this->redirectToRoute('categories');
    }       
    
    public function getAllCategories(CategoryTreeAdminOptionList $categories)
    {
        $categories->getCategoryList($categories->buildTree());
        return $this-> render('admin/_all_categories.html.twig',[
            'categories'=>$categories
        ]);

    }
}
