<?php
class CommandeDAO
{
    private PDO $_cnx;

    public function __construct(PDO $_cnx)
    {
        $this->_cnx = $_cnx;
    }

    public function getAllCommandes(): ?array
    {
        $query = "SELECT c.*, cl.nom, cl.prenom, cl.email 
                  FROM commande c 
                  JOIN client cl ON c.id_client = cl.id_client 
                  ORDER BY c.date_achat DESC";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur getAllCommandes : " . $e->getMessage();
            return null;
        }
    }

    public function getCommandesByClient(int $id_client): ?array
    {
        $query = "SELECT * FROM commande WHERE id_client = :id ORDER BY date_achat DESC";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id', $id_client, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur getCommandesByClient : " . $e->getMessage();
            return null;
        }
    }

    public function ajoutCommande(int $id_client): ?int
    {
        $query = "SELECT ajout_commande(:id_client) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id_client', $id_client, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetchColumn(0);
            $this->_cnx->commit();
            return $data ? (int)$data : null;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            print "Erreur ajoutCommande : " . $e->getMessage();
            return null;
        }
    }

    public function updateStatut(int $id_commande, bool $statut): bool
    {
        $query = "SELECT update_statut_commande(:id, :statut)";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id',     $id_commande, PDO::PARAM_INT);
            $stmt->bindValue(':statut', $statut, PDO::PARAM_BOOL);
            $stmt->execute();
            $this->_cnx->commit();
            return true;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            print "Erreur updateStatut : " . $e->getMessage();
            return false;
        }
    }
}
