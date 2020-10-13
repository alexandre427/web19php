<?php
namespace src\Controller;

use src\Model\Categorie;
use src\Model\BDD;

class CategorieController extends AbstractController {

    public function Add(){
        if($_POST){
            $objCategory = new Categorie();
            $objCategory->setCategoryName($_POST["CategoryName"]);
            $objCategory->setCategorySlug($_POST["CategorySlug"]);

            //Exécuter l'insertion
            $CategoryId = $objCategory->AddCategory(BDD::getInstance());
            // Redirection
            header("Location:/categorie/show/$CategoryId");
        }else{
            return $this->twig->render("category/add.html.twig");
        }


    }



    public function All(){
        $category = new Categorie();
        $datas = $category->GetCategoryAll(BDD::getInstance());

        return $this->twig->render("category/all.html.twig", [
            "categoryList"=>$datas
        ]);
    }

    public function Show($CategoryId){
        $category = new Categorie();
        $datas = $category->GetCategorybyId(BDD::getInstance(),$CategoryId);
        return $this->twig->render("category/show.html.twig", [
            "category"=>$datas
        ]);
    }

    public function Delete($CategoryId){
        $category = new Categorie();
        $datas = $category->GetDeleteCategory(BDD::getInstance(),$CategoryId);

        header("Location:/categorie/All");
    }

    public function Update($CategoryId){
        $category = new Categorie();
        $datas = $category->GetCategorybyId(BDD::getInstance(),$CategoryId);

        if($_POST){
            $objCategory = new Categorie();
            $objCategory->setCategoryName($_POST["CategoryName"]);
            $objCategory->setCategorySlug($_POST["CategorySlug"]);
            $objCategory->setCategoryId($CategoryId);
            //Exécuter la mise à jour
            $objCategory->GetCategoryUpdate(BDD::getInstance());
            // Redirection
            header("Location:/categorie/show/$CategoryId");
        }else{
            return $this->twig->render("category/update.html.twig", [
                "category"=>$datas
            ]);
        }

    }



}