<?php
class AdminDAO
{
    private PDO $_cnx;

    public function __construct(PDO $_cnx)
    {
        $this->_cnx = $_cnx;
    }

    public function getAdmin(string $login, string $mot_de_passe): ?Admin
    {
        $query = "SELECT * FROM get_admin(:login::text, :mdp::text)";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':login', $login);
            $stmt->bindValue(':mdp',   $mot_de_passe);
            $stmt->execute();
            $d = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$d) return null;
            return new Admin(
                id_admin: (int)$d['id_admin'],
                login:    (string)$d['login'],
            );
        } catch (PDOException $e) {
            print "Erreur getAdmin : " . $e->getMessage();
            return null;
        }
    }
}
