<?php
class InfoPointureDAO
{
    private PDO $_cnx;

    public function __construct(PDO $_cnx)
    {
        $this->_cnx = $_cnx;
    }


    public function getPointuresByChaussure(int $id_chaussure): ?array
    {
        $query = "SELECT * FROM info_pointure WHERE id_chaussure = :id ORDER BY pointure";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id', $id_chaussure);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array_map(function ($d) {
                return new InfoPointure(
                    id_info_pointure: (int)$d['id_info_pointure'],
                    pointure:         (int)$d['pointure'],
                    stock:            (int)$d['stock'],
                    id_chaussure:     (int)$d['id_chaussure'],
                );
            }, $data);
        } catch (PDOException $e) {
            print "Erreur getPointuresByChaussure : " . $e->getMessage();
            return null;
        }
    }


    public function ajoutInfoPointure(int $pointure, int $stock, int $id_chaussure): ?int
    {
        $query = "SELECT ajout_info_pointure(:pointure, :stock, :id_chaussure) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':pointure',     $pointure);
            $stmt->bindValue(':stock',        $stock);
            $stmt->bindValue(':id_chaussure', $id_chaussure);
            $stmt->execute();
            $data = $stmt->fetchColumn(0);
            $this->_cnx->commit();
            return $data ? (int)$data : null;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            print "Erreur ajoutInfoPointure : " . $e->getMessage();
            return null;
        }
    }


    public function updateStock(int $id_info_pointure, int $stock): bool
    {
        $query = "SELECT update_stock(:id, :stock)";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id',    $id_info_pointure);
            $stmt->bindValue(':stock', $stock);
            $stmt->execute();
            $this->_cnx->commit();
            return true;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            print "Erreur updateStock : " . $e->getMessage();
            return false;
        }
    }
}
