<?php
class ContenuCommandeDAO
{
    private PDO $_cnx;

    public function __construct(PDO $_cnx)
    {
        $this->_cnx = $_cnx;
    }

    public function ajoutContenuCommande(int $quantite, float $prix, int $id_commande, int $id_info_pointure): ?int
    {
        $query = "SELECT ajout_contenu_commande(:quantite, :prix, :id_commande, :id_info_pointure) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':quantite',         $quantite, PDO::PARAM_INT);
            $stmt->bindValue(':prix',             $prix);
            $stmt->bindValue(':id_commande',      $id_commande, PDO::PARAM_INT);
            $stmt->bindValue(':id_info_pointure', $id_info_pointure, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetchColumn(0);
            $this->_cnx->commit();
            return $data ? (int)$data : null;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            print "Erreur ajoutContenuCommande : " . $e->getMessage();
            return null;
        }
    }

    public function getContenuByCommande(int $id_commande): ?array
    {
        $query = "SELECT cc.*, ip.pointure, c.modele, c.marque
                  FROM contenu_commande cc
                  JOIN info_pointure ip ON cc.id_info_pointure = ip.id_info_pointure
                  JOIN chaussure c ON ip.id_chaussure = c.id_chaussure
                  WHERE cc.id_commande = :id";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id', $id_commande, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur getContenuByCommande : " . $e->getMessage();
            return null;
        }
    }
}
