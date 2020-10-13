<?php
namespace src\Model;

class Categorie {
    private $CategoryId;
    private $CategoryName;
    private $CategorySlug;



    public function AddCategory(\PDO $bdd){
        try {
            $requete = $bdd->prepare("INSERT INTO techno_category (
            CategoryName, CategorySlug) VALUES(:CategoryName, :CategorySlug)");

            $requete->execute([
                "CategoryName" => $this->getCategoryName(),
                "CategorySlug" => $this->getCategorySlug(),
            ]);
            return $bdd->lastInsertId();
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    public function GetCategoryUpdate(\PDO $bdd){
        try {
            $requete = $bdd->prepare("UPDATE techno_category set 
            CategoryName = :CategoryName, 
            CategorySlug = :CategorySlug
             WHERE CategoryId = :CategoryId");

            $requete->execute([
                "CategoryName" => $this->getCategoryName(),
                "CategorySlug" => $this->getCategorySlug(),
                "CategoryId" => $this->getCategoryId()
            ]);
            return "OK";
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }
    /**
     * Récupère tous les articles
     * @param \PDO $bdd
     * @return array
     */
    public function GetCategoryAll(\PDO $bdd){
        $requete = $bdd->prepare("SELECT * FROM techno_category");
        $requete->execute();
        //$datas =  $requete->fetchAll(\PDO::FETCH_ASSOC);
        $datas =  $requete->fetchAll(\PDO::FETCH_CLASS,'src\Model\Categorie');
        return $datas;

    }

    public function GetCategorybyId(\PDO $bdd, $CategoryId){
        $requete = $bdd->prepare("SELECT * FROM techno_category WHERE CategoryId=:CategoryId");
        $requete->execute([
            "CategoryId" => $CategoryId
        ]);
        $requete->setFetchMode(\PDO::FETCH_CLASS,'src\Model\Categorie');
        $categorie = $requete->fetch();

        return $categorie;
    }

    public function GetDeleteCategory(\PDO $bdd, $CategoryId){
        $requete = $bdd->prepare("DELETE FROM techno_category WHERE CategoryId=:CategoryId");
        $requete->execute([
            "CategoryId" => $CategoryId
        ]);
        return true;
    }
    public function SqlTruncate(\PDO $bdd){
        $requete = $bdd->prepare("TRUNCATE TABLE articles");
        $requete->execute();
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->CategoryId;
    }

    /**
     * @param mixed $CategoryId
     * @return Categorie
     */
    public function setCategoryId($CategoryId)
    {
        $this->CategoryId = $CategoryId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->CategoryName;
    }

    /**
     * @param mixed $CategoryName
     * @return Categorie
     */
    public function setCategoryName($CategoryName)
    {
        $this->CategoryName = $CategoryName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategorySlug()
    {
        return $this->CategorySlug;
    }

    /**
     * @param mixed $CategorySlug
     * @return Categorie
     */
    public function setCategorySlug($CategorySlug)
    {
        $this->CategorySlug = $CategorySlug;
        return $this;
    }



}