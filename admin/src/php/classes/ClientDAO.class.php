<?php
class ClientDAO
{
    private PDO $_cnx;

    public function __construct(PDO $_cnx)
    {
        $this->_cnx = $_cnx;
    }


    public function getClientByEmail(string $email): ?Client
    {
        $query = "SELECT * FROM client WHERE email = :email";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $d = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$d) return null;

            return new Client(
                id_client:    (int)$d['id_client'],
                nom:          (string)$d['nom'],
                prenom:       (string)$d['prenom'],
                email:        (string)$d['email'],
                mot_de_passe: (string)$d['mot_de_passe'],
            );
        } catch (PDOException $e) {
            print "Erreur getClientByEmail : " . $e->getMessage();
            return null;
        }
    }


    public function getClientById(int $id_client): ?Client
    {
        $query = "SELECT * FROM client WHERE id_client = :id";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id', $id_client);
            $stmt->execute();
            $d = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$d) return null;

            return new Client(
                id_client:    (int)$d['id_client'],
                nom:          (string)$d['nom'],
                prenom:       (string)$d['prenom'],
                email:        (string)$d['email'],
                mot_de_passe: (string)$d['mot_de_passe'],
            );
        } catch (PDOException $e) {
            print "Erreur getClientById : " . $e->getMessage();
            return null;
        }
    }


    public function ajoutClient(string $nom, string $prenom, string $email, string $mot_de_passe): ?int
    {
        $query = "SELECT ajout_client(:nom, :prenom, :email, :mot_de_passe) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':nom',          $nom);
            $stmt->bindValue(':prenom',       $prenom);
            $stmt->bindValue(':email',        $email);
            $stmt->bindValue(':mot_de_passe', password_hash($mot_de_passe, PASSWORD_DEFAULT));
            $stmt->execute();
            $data = $stmt->fetchColumn(0);
            $this->_cnx->commit();
            return $data ? (int)$data : null;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            print "Erreur ajoutClient : " . $e->getMessage();
            return null;
        }
    }


    public function checkLogin(string $email, string $mot_de_passe): ?Client
    {
        $client = $this->getClientByEmail($email);
        if ($client && password_verify($mot_de_passe, $client->mot_de_passe)) {
            return $client;
        }
        return null;
    }
}
