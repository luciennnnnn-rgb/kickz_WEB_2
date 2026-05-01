<?php
class ChaussureDAO
{
    private PDO $_cnx;

    public function __construct(PDO $_cnx)
    {
        $this->_cnx = $_cnx;
    }


    public function getAllChaussures(): ?array
    {
        $query = "SELECT * FROM chaussure ORDER BY id_chaussure";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array_map(function ($d) {
                return new Chaussure(
                    id_chaussure: (int)$d['id_chaussure'],
                    modele:       (string)$d['modele'],
                    marque:       (string)$d['marque'],
                    prix:         (float)$d['prix'],
                    description:  (string)$d['description'],
                );
            }, $data);
        } catch (PDOException $e) {
            print "Erreur getAllChaussures : " . $e->getMessage();
            return null;
        }
    }


    public function getChaussureById(int $id_chaussure): ?Chaussure
    {
        $query = "SELECT * FROM chaussure WHERE id_chaussure = :id";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id', $id_chaussure);
            $stmt->execute();
            $d = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$d) return null;

            return new Chaussure(
                id_chaussure: (int)$d['id_chaussure'],
                modele:       (string)$d['modele'],
                marque:       (string)$d['marque'],
                prix:         (float)$d['prix'],
                description:  (string)$d['description'],
            );
        } catch (PDOException $e) {
            print "Erreur getChaussureById : " . $e->getMessage();
            return null;
        }
    }


    public function getChaussuresByMarque(string $marque): ?array
    {
        $query = "SELECT * FROM chaussure WHERE marque = :marque ORDER BY id_chaussure";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':marque', $marque);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array_map(function ($d) {
                return new Chaussure(
                    id_chaussure: (int)$d['id_chaussure'],
                    modele:       (string)$d['modele'],
                    marque:       (string)$d['marque'],
                    prix:         (float)$d['prix'],
                    description:  (string)$d['description'],
                );
            }, $data);
        } catch (PDOException $e) {
            print "Erreur getChaussuresByMarque : " . $e->getMessage();
            return null;
        }
    }


    public function ajoutChaussure(string $modele, string $marque, float $prix, string $description): ?int
    {
        $query = "SELECT ajout_chaussure(:modele, :marque, :prix, :description) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':modele',      $modele);
            $stmt->bindValue(':marque',      $marque);
            $stmt->bindValue(':prix',        $prix);
            $stmt->bindValue(':description', $description);
            $stmt->execute();
            $data = $stmt->fetchColumn(0);
            $this->_cnx->commit();
            return $data ? (int)$data : null;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            print "Erreur ajoutChaussure : " . $e->getMessage();
            return null;
        }
    }


    public function updateChampChaussure(int $id_chaussure, string $champ, string $valeur): bool
    {
        $query = "SELECT update_champ_chaussure(:id, :champ, :valeur)";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id',    $id_chaussure);
            $stmt->bindValue(':champ', $champ);
            $stmt->bindValue(':valeur',$valeur);
            $stmt->execute();
            $this->_cnx->commit();
            return true;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            print "Erreur updateChampChaussure : " . $e->getMessage();
            return false;
        }
    }

    // Supprime une chaussure via la fonction plpgsql
    public function effacerChaussure(int $id_chaussure): bool
    {
        $query = "SELECT effacer_chaussure(:id)";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id', $id_chaussure);
            $stmt->execute();
            $this->_cnx->commit();
            return true;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            print "Erreur effacerChaussure : " . $e->getMessage();
            return false;
        }
    }
}
