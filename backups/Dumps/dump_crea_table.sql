CREATE TABLE client (
    id_client   SERIAL PRIMARY KEY,
    nom         TEXT        NOT NULL,
    prenom      TEXT        NOT NULL,
    email       TEXT        NOT NULL UNIQUE,
    mot_de_passe TEXT       NOT NULL
);

CREATE TABLE adresse (
    id_adresse  SERIAL PRIMARY KEY,
    num_rue     INT         NOT NULL,
    nom_rue     TEXT        NOT NULL,
    code_postal TEXT        NOT NULL,
    ville       TEXT        NOT NULL,
    id_client   INT         NOT NULL REFERENCES client(id_client) ON DELETE CASCADE
);

CREATE TABLE chaussure (
    id_chaussure SERIAL PRIMARY KEY,
    modele       TEXT        NOT NULL,
    marque       TEXT        NOT NULL,
    prix         FLOAT       NOT NULL,
    description  TEXT
);

CREATE TABLE info_pointure (
    id_info_pointure SERIAL PRIMARY KEY,
    pointure         INT     NOT NULL,
    stock            INT     NOT NULL DEFAULT 0,
    id_chaussure     INT     NOT NULL REFERENCES chaussure(id_chaussure) ON DELETE CASCADE
);

CREATE TABLE commande (
    id_commande      SERIAL PRIMARY KEY,
    date_achat       DATE        NOT NULL DEFAULT CURRENT_DATE,
    statut_livraison BOOLEAN     NOT NULL DEFAULT FALSE,
    id_client        INT         NOT NULL REFERENCES client(id_client) ON DELETE CASCADE
);

CREATE TABLE contenu_commande (
    id_contenu_commande SERIAL PRIMARY KEY,
    quantite_achetee    INT     NOT NULL,
    prix_unitaire       FLOAT   NOT NULL,
    id_commande         INT     NOT NULL REFERENCES commande(id_commande) ON DELETE CASCADE,
    id_info_pointure    INT     NOT NULL REFERENCES info_pointure(id_info_pointure)
);

CREATE TABLE avis (
    id_avis      SERIAL PRIMARY KEY,
    commentaire  TEXT    NOT NULL,
    id_client    INT     NOT NULL REFERENCES client(id_client) ON DELETE CASCADE,
    id_chaussure INT     NOT NULL REFERENCES chaussure(id_chaussure) ON DELETE CASCADE
);

CREATE TABLE livraison (
    id_livraison SERIAL PRIMARY KEY,
    date_prevue  DATE,
    date_reelle  DATE,
    num_suivi    TEXT,
    id_commande  INT     NOT NULL REFERENCES commande(id_commande) ON DELETE CASCADE,
    id_adresse   INT     NOT NULL REFERENCES adresse(id_adresse)
);

CREATE TABLE admin (
    id_admin     SERIAL PRIMARY KEY,
    login        TEXT    NOT NULL UNIQUE,
    mot_de_passe TEXT    NOT NULL
);

DROP TABLE IF EXISTS livraison        CASCADE;
DROP TABLE IF EXISTS avis             CASCADE;
DROP TABLE IF EXISTS contenu_commande CASCADE;
DROP TABLE IF EXISTS commande         CASCADE;
DROP TABLE IF EXISTS info_pointure    CASCADE;
DROP TABLE IF EXISTS chaussure        CASCADE;
DROP TABLE IF EXISTS adresse          CASCADE;
DROP TABLE IF EXISTS client           CASCADE;
DROP TABLE IF EXISTS admin            CASCADE;