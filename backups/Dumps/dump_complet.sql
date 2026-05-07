--
-- PostgreSQL database dump
--

\restrict hqT6Qpd5m71MB55MD4ceubznCv4y2ce4ujF932pamDeGKsAa0WtCdib22vK2NwD

-- Dumped from database version 18.1
-- Dumped by pg_dump version 18.1

-- Started on 2026-05-07 09:29:12

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 250 (class 1255 OID 25111)
-- Name: ajout_admin(text, text); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.ajout_admin(p_login text, p_mot_de_passe text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
v_id INT;
BEGIN
INSERT INTO admin(login, mot_de_passe)
VALUES (p_login, p_mot_de_passe)
    RETURNING id_admin INTO v_id;
RETURN v_id;
END;
$$;


ALTER FUNCTION public.ajout_admin(p_login text, p_mot_de_passe text) OWNER TO anonyme;

--
-- TOC entry 238 (class 1255 OID 25099)
-- Name: ajout_adresse(integer, text, text, text, integer); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.ajout_adresse(p_num_rue integer, p_nom_rue text, p_code_postal text, p_ville text, p_id_client integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
v_id INT;
BEGIN
INSERT INTO adresse(num_rue, nom_rue, code_postal, ville, id_client)
VALUES (p_num_rue, p_nom_rue, p_code_postal, p_ville, p_id_client)
    RETURNING id_adresse INTO v_id;
RETURN v_id;
END;
$$;


ALTER FUNCTION public.ajout_adresse(p_num_rue integer, p_nom_rue text, p_code_postal text, p_ville text, p_id_client integer) OWNER TO anonyme;

--
-- TOC entry 246 (class 1255 OID 25107)
-- Name: ajout_avis(text, integer, integer); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.ajout_avis(p_commentaire text, p_id_client integer, p_id_chaussure integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
v_id INT;
BEGIN
INSERT INTO avis(commentaire, id_client, id_chaussure)
VALUES (p_commentaire, p_id_client, p_id_chaussure)
    RETURNING id_avis INTO v_id;
RETURN v_id;
END;
$$;


ALTER FUNCTION public.ajout_avis(p_commentaire text, p_id_client integer, p_id_chaussure integer) OWNER TO anonyme;

--
-- TOC entry 239 (class 1255 OID 25100)
-- Name: ajout_chaussure(text, text, double precision, text); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.ajout_chaussure(p_modele text, p_marque text, p_prix double precision, p_description text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
v_id INT;
BEGIN
INSERT INTO chaussure(modele, marque, prix, description)
VALUES (p_modele, p_marque, p_prix, p_description)
    RETURNING id_chaussure INTO v_id;
RETURN v_id;
END;
$$;


ALTER FUNCTION public.ajout_chaussure(p_modele text, p_marque text, p_prix double precision, p_description text) OWNER TO anonyme;

--
-- TOC entry 237 (class 1255 OID 25098)
-- Name: ajout_client(text, text, text, text); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.ajout_client(p_nom text, p_prenom text, p_email text, p_mot_de_passe text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
v_id INT;
BEGIN
INSERT INTO client(nom, prenom, email, mot_de_passe)
VALUES (p_nom, p_prenom, p_email, p_mot_de_passe)
    RETURNING id_client INTO v_id;
RETURN v_id;
END;
$$;


ALTER FUNCTION public.ajout_client(p_nom text, p_prenom text, p_email text, p_mot_de_passe text) OWNER TO anonyme;

--
-- TOC entry 243 (class 1255 OID 25104)
-- Name: ajout_commande(integer); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.ajout_commande(p_id_client integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
v_id INT;
BEGIN
INSERT INTO commande(id_client)
VALUES (p_id_client)
    RETURNING id_commande INTO v_id;
RETURN v_id;
END;
$$;


ALTER FUNCTION public.ajout_commande(p_id_client integer) OWNER TO anonyme;

--
-- TOC entry 245 (class 1255 OID 25106)
-- Name: ajout_contenu_commande(integer, double precision, integer, integer); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.ajout_contenu_commande(p_quantite_achetee integer, p_prix_unitaire double precision, p_id_commande integer, p_id_info_pointure integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
v_id INT;
BEGIN
INSERT INTO contenu_commande(quantite_achetee, prix_unitaire, id_commande, id_info_pointure)
VALUES (p_quantite_achetee, p_prix_unitaire, p_id_commande, p_id_info_pointure)
    RETURNING id_contenu_commande INTO v_id;
RETURN v_id;
END;
$$;


ALTER FUNCTION public.ajout_contenu_commande(p_quantite_achetee integer, p_prix_unitaire double precision, p_id_commande integer, p_id_info_pointure integer) OWNER TO anonyme;

--
-- TOC entry 241 (class 1255 OID 25102)
-- Name: ajout_info_pointure(integer, integer, integer); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.ajout_info_pointure(p_pointure integer, p_stock integer, p_id_chaussure integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
v_id INT;
BEGIN
INSERT INTO info_pointure(pointure, stock, id_chaussure)
VALUES (p_pointure, p_stock, p_id_chaussure)
    RETURNING id_info_pointure INTO v_id;
RETURN v_id;
END;
$$;


ALTER FUNCTION public.ajout_info_pointure(p_pointure integer, p_stock integer, p_id_chaussure integer) OWNER TO anonyme;

--
-- TOC entry 248 (class 1255 OID 25109)
-- Name: ajout_livraison(date, text, integer, integer); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.ajout_livraison(p_date_prevue date, p_num_suivi text, p_id_commande integer, p_id_adresse integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
v_id INT;
BEGIN
INSERT INTO livraison(date_prevue, num_suivi, id_commande, id_adresse)
VALUES (p_date_prevue, p_num_suivi, p_id_commande, p_id_adresse)
    RETURNING id_livraison INTO v_id;
RETURN v_id;
END;
$$;


ALTER FUNCTION public.ajout_livraison(p_date_prevue date, p_num_suivi text, p_id_commande integer, p_id_adresse integer) OWNER TO anonyme;

--
-- TOC entry 247 (class 1255 OID 25108)
-- Name: effacer_avis(integer); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.effacer_avis(p_id_avis integer) RETURNS void
    LANGUAGE plpgsql
    AS $$
BEGIN
DELETE FROM avis WHERE id_avis = p_id_avis;
END;
$$;


ALTER FUNCTION public.effacer_avis(p_id_avis integer) OWNER TO anonyme;

--
-- TOC entry 240 (class 1255 OID 25101)
-- Name: effacer_chaussure(integer); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.effacer_chaussure(p_id_chaussure integer) RETURNS void
    LANGUAGE plpgsql
    AS $$
BEGIN
DELETE FROM chaussure WHERE id_chaussure = p_id_chaussure;
END;
$$;


ALTER FUNCTION public.effacer_chaussure(p_id_chaussure integer) OWNER TO anonyme;

--
-- TOC entry 251 (class 1255 OID 25182)
-- Name: get_admin(text, text); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.get_admin(p_login text, p_mot_de_passe text) RETURNS TABLE(id_admin integer, login text)
    LANGUAGE plpgsql
    AS $$
BEGIN
RETURN QUERY
SELECT a.id_admin, a.login
FROM admin a
WHERE a.login = p_login AND a.mot_de_passe = p_mot_de_passe;
END;
$$;


ALTER FUNCTION public.get_admin(p_login text, p_mot_de_passe text) OWNER TO anonyme;

--
-- TOC entry 249 (class 1255 OID 25110)
-- Name: update_livraison(integer, date, text); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.update_livraison(p_id_livraison integer, p_date_reelle date, p_num_suivi text) RETURNS void
    LANGUAGE plpgsql
    AS $$
BEGIN
UPDATE livraison
SET date_reelle = p_date_reelle, num_suivi = p_num_suivi
WHERE id_livraison = p_id_livraison;
END;
$$;


ALTER FUNCTION public.update_livraison(p_id_livraison integer, p_date_reelle date, p_num_suivi text) OWNER TO anonyme;

--
-- TOC entry 244 (class 1255 OID 25105)
-- Name: update_statut_commande(integer, boolean); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.update_statut_commande(p_id_commande integer, p_statut_livraison boolean) RETURNS void
    LANGUAGE plpgsql
    AS $$
BEGIN
UPDATE commande SET statut_livraison = p_statut_livraison
WHERE id_commande = p_id_commande;
END;
$$;


ALTER FUNCTION public.update_statut_commande(p_id_commande integer, p_statut_livraison boolean) OWNER TO anonyme;

--
-- TOC entry 242 (class 1255 OID 25103)
-- Name: update_stock(integer, integer); Type: FUNCTION; Schema: public; Owner: anonyme
--

CREATE FUNCTION public.update_stock(p_id_info_pointure integer, p_stock integer) RETURNS void
    LANGUAGE plpgsql
    AS $$
BEGIN
UPDATE info_pointure SET stock = p_stock
WHERE id_info_pointure = p_id_info_pointure;
END;
$$;


ALTER FUNCTION public.update_stock(p_id_info_pointure integer, p_stock integer) OWNER TO anonyme;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 236 (class 1259 OID 25085)
-- Name: admin; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.admin (
                              id_admin integer NOT NULL,
                              login text NOT NULL,
                              mot_de_passe text NOT NULL
);


ALTER TABLE public.admin OWNER TO anonyme;

--
-- TOC entry 235 (class 1259 OID 25084)
-- Name: admin_id_admin_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.admin_id_admin_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.admin_id_admin_seq OWNER TO anonyme;

--
-- TOC entry 5124 (class 0 OID 0)
-- Dependencies: 235
-- Name: admin_id_admin_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.admin_id_admin_seq OWNED BY public.admin.id_admin;


--
-- TOC entry 222 (class 1259 OID 24950)
-- Name: adresse; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.adresse (
                                id_adresse integer NOT NULL,
                                num_rue integer NOT NULL,
                                nom_rue text NOT NULL,
                                code_postal text NOT NULL,
                                ville text NOT NULL,
                                id_client integer NOT NULL
);


ALTER TABLE public.adresse OWNER TO anonyme;

--
-- TOC entry 221 (class 1259 OID 24949)
-- Name: adresse_id_adresse_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.adresse_id_adresse_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.adresse_id_adresse_seq OWNER TO anonyme;

--
-- TOC entry 5125 (class 0 OID 0)
-- Dependencies: 221
-- Name: adresse_id_adresse_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.adresse_id_adresse_seq OWNED BY public.adresse.id_adresse;


--
-- TOC entry 232 (class 1259 OID 25040)
-- Name: avis; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.avis (
                             id_avis integer NOT NULL,
                             commentaire text NOT NULL,
                             id_client integer NOT NULL,
                             id_chaussure integer NOT NULL
);


ALTER TABLE public.avis OWNER TO anonyme;

--
-- TOC entry 231 (class 1259 OID 25039)
-- Name: avis_id_avis_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.avis_id_avis_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.avis_id_avis_seq OWNER TO anonyme;

--
-- TOC entry 5126 (class 0 OID 0)
-- Dependencies: 231
-- Name: avis_id_avis_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.avis_id_avis_seq OWNED BY public.avis.id_avis;


--
-- TOC entry 224 (class 1259 OID 24970)
-- Name: chaussure; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.chaussure (
                                  id_chaussure integer NOT NULL,
                                  modele text NOT NULL,
                                  marque text NOT NULL,
                                  prix double precision NOT NULL,
                                  description text
);


ALTER TABLE public.chaussure OWNER TO anonyme;

--
-- TOC entry 223 (class 1259 OID 24969)
-- Name: chaussure_id_chaussure_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.chaussure_id_chaussure_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.chaussure_id_chaussure_seq OWNER TO anonyme;

--
-- TOC entry 5127 (class 0 OID 0)
-- Dependencies: 223
-- Name: chaussure_id_chaussure_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.chaussure_id_chaussure_seq OWNED BY public.chaussure.id_chaussure;


--
-- TOC entry 220 (class 1259 OID 24934)
-- Name: client; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.client (
                               id_client integer NOT NULL,
                               nom text NOT NULL,
                               prenom text NOT NULL,
                               email text NOT NULL,
                               mot_de_passe text NOT NULL
);


ALTER TABLE public.client OWNER TO anonyme;

--
-- TOC entry 219 (class 1259 OID 24933)
-- Name: client_id_client_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.client_id_client_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.client_id_client_seq OWNER TO anonyme;

--
-- TOC entry 5128 (class 0 OID 0)
-- Dependencies: 219
-- Name: client_id_client_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.client_id_client_seq OWNED BY public.client.id_client;


--
-- TOC entry 228 (class 1259 OID 25000)
-- Name: commande; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.commande (
                                 id_commande integer NOT NULL,
                                 date_achat date DEFAULT CURRENT_DATE NOT NULL,
                                 statut_livraison boolean DEFAULT false NOT NULL,
                                 id_client integer NOT NULL
);


ALTER TABLE public.commande OWNER TO anonyme;

--
-- TOC entry 227 (class 1259 OID 24999)
-- Name: commande_id_commande_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.commande_id_commande_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.commande_id_commande_seq OWNER TO anonyme;

--
-- TOC entry 5129 (class 0 OID 0)
-- Dependencies: 227
-- Name: commande_id_commande_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.commande_id_commande_seq OWNED BY public.commande.id_commande;


--
-- TOC entry 230 (class 1259 OID 25018)
-- Name: contenu_commande; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.contenu_commande (
                                         id_contenu_commande integer NOT NULL,
                                         quantite_achetee integer NOT NULL,
                                         prix_unitaire double precision NOT NULL,
                                         id_commande integer NOT NULL,
                                         id_info_pointure integer NOT NULL
);


ALTER TABLE public.contenu_commande OWNER TO anonyme;

--
-- TOC entry 229 (class 1259 OID 25017)
-- Name: contenu_commande_id_contenu_commande_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.contenu_commande_id_contenu_commande_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.contenu_commande_id_contenu_commande_seq OWNER TO anonyme;

--
-- TOC entry 5130 (class 0 OID 0)
-- Dependencies: 229
-- Name: contenu_commande_id_contenu_commande_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.contenu_commande_id_contenu_commande_seq OWNED BY public.contenu_commande.id_contenu_commande;


--
-- TOC entry 226 (class 1259 OID 24983)
-- Name: info_pointure; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.info_pointure (
                                      id_info_pointure integer NOT NULL,
                                      pointure integer NOT NULL,
                                      stock integer DEFAULT 0 NOT NULL,
                                      id_chaussure integer NOT NULL
);


ALTER TABLE public.info_pointure OWNER TO anonyme;

--
-- TOC entry 225 (class 1259 OID 24982)
-- Name: info_pointure_id_info_pointure_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.info_pointure_id_info_pointure_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.info_pointure_id_info_pointure_seq OWNER TO anonyme;

--
-- TOC entry 5131 (class 0 OID 0)
-- Dependencies: 225
-- Name: info_pointure_id_info_pointure_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.info_pointure_id_info_pointure_seq OWNED BY public.info_pointure.id_info_pointure;


--
-- TOC entry 234 (class 1259 OID 25063)
-- Name: livraison; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.livraison (
                                  id_livraison integer NOT NULL,
                                  date_prevue date,
                                  date_reelle date,
                                  num_suivi text,
                                  id_commande integer NOT NULL,
                                  id_adresse integer NOT NULL
);


ALTER TABLE public.livraison OWNER TO anonyme;

--
-- TOC entry 233 (class 1259 OID 25062)
-- Name: livraison_id_livraison_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.livraison_id_livraison_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.livraison_id_livraison_seq OWNER TO anonyme;

--
-- TOC entry 5132 (class 0 OID 0)
-- Dependencies: 233
-- Name: livraison_id_livraison_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.livraison_id_livraison_seq OWNED BY public.livraison.id_livraison;


--
-- TOC entry 4922 (class 2604 OID 25088)
-- Name: admin id_admin; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.admin ALTER COLUMN id_admin SET DEFAULT nextval('public.admin_id_admin_seq'::regclass);


--
-- TOC entry 4912 (class 2604 OID 24953)
-- Name: adresse id_adresse; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.adresse ALTER COLUMN id_adresse SET DEFAULT nextval('public.adresse_id_adresse_seq'::regclass);


--
-- TOC entry 4920 (class 2604 OID 25043)
-- Name: avis id_avis; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.avis ALTER COLUMN id_avis SET DEFAULT nextval('public.avis_id_avis_seq'::regclass);


--
-- TOC entry 4913 (class 2604 OID 24973)
-- Name: chaussure id_chaussure; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.chaussure ALTER COLUMN id_chaussure SET DEFAULT nextval('public.chaussure_id_chaussure_seq'::regclass);


--
-- TOC entry 4911 (class 2604 OID 24937)
-- Name: client id_client; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.client ALTER COLUMN id_client SET DEFAULT nextval('public.client_id_client_seq'::regclass);


--
-- TOC entry 4916 (class 2604 OID 25003)
-- Name: commande id_commande; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.commande ALTER COLUMN id_commande SET DEFAULT nextval('public.commande_id_commande_seq'::regclass);


--
-- TOC entry 4919 (class 2604 OID 25021)
-- Name: contenu_commande id_contenu_commande; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.contenu_commande ALTER COLUMN id_contenu_commande SET DEFAULT nextval('public.contenu_commande_id_contenu_commande_seq'::regclass);


--
-- TOC entry 4914 (class 2604 OID 24986)
-- Name: info_pointure id_info_pointure; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.info_pointure ALTER COLUMN id_info_pointure SET DEFAULT nextval('public.info_pointure_id_info_pointure_seq'::regclass);


--
-- TOC entry 4921 (class 2604 OID 25066)
-- Name: livraison id_livraison; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.livraison ALTER COLUMN id_livraison SET DEFAULT nextval('public.livraison_id_livraison_seq'::regclass);


--
-- TOC entry 5118 (class 0 OID 25085)
-- Dependencies: 236
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.admin (id_admin, login, mot_de_passe) FROM stdin;
1	admin	123
\.


--
-- TOC entry 5104 (class 0 OID 24950)
-- Dependencies: 222
-- Data for Name: adresse; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.adresse (id_adresse, num_rue, nom_rue, code_postal, ville, id_client) FROM stdin;
\.


--
-- TOC entry 5114 (class 0 OID 25040)
-- Dependencies: 232
-- Data for Name: avis; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.avis (id_avis, commentaire, id_client, id_chaussure) FROM stdin;
\.


--
-- TOC entry 5106 (class 0 OID 24970)
-- Dependencies: 224
-- Data for Name: chaussure; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.chaussure (id_chaussure, modele, marque, prix, description) FROM stdin;
1	Air Force 1	Nike	119.99	Basket classique en cuir blanc, incontournable du streetwear.
2	Stan Smith	Adidas	100	Modèle épuré et intemporel avec ses trois bandes perforées.
3	Chuck Taylor All Star	Converse	75	Basket montante en toile, célèbre pour son design rétro.
4	Speedcross 6	Salomon	150	Chaussure de trail robuste conçue pour les terrains difficiles.
5	574	New Balance	110	Basket au style hybride mêlant confort moderne et design classique.
6	Air Max	Nike	110	test
7	470	New Balance	80	test nb
\.


--
-- TOC entry 5102 (class 0 OID 24934)
-- Dependencies: 220
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.client (id_client, nom, prenom, email, mot_de_passe) FROM stdin;
1	Vekemans	Lucien	vekemanslucien@gmail.com	$2y$10$.NQ2HxyYIaTk/H/VFTatAOo8TByHruZ/hOEq32TZ4NiADZeADb8hu
\.


--
-- TOC entry 5110 (class 0 OID 25000)
-- Dependencies: 228
-- Data for Name: commande; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.commande (id_commande, date_achat, statut_livraison, id_client) FROM stdin;
1	2026-05-06	f	1
\.


--
-- TOC entry 5112 (class 0 OID 25018)
-- Dependencies: 230
-- Data for Name: contenu_commande; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.contenu_commande (id_contenu_commande, quantite_achetee, prix_unitaire, id_commande, id_info_pointure) FROM stdin;
1	1	110	1	2
\.


--
-- TOC entry 5108 (class 0 OID 24983)
-- Dependencies: 226
-- Data for Name: info_pointure; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.info_pointure (id_info_pointure, pointure, stock, id_chaussure) FROM stdin;
1	45	3	6
2	43	3	6
\.


--
-- TOC entry 5116 (class 0 OID 25063)
-- Dependencies: 234
-- Data for Name: livraison; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.livraison (id_livraison, date_prevue, date_reelle, num_suivi, id_commande, id_adresse) FROM stdin;
\.


--
-- TOC entry 5133 (class 0 OID 0)
-- Dependencies: 235
-- Name: admin_id_admin_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.admin_id_admin_seq', 1, true);


--
-- TOC entry 5134 (class 0 OID 0)
-- Dependencies: 221
-- Name: adresse_id_adresse_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.adresse_id_adresse_seq', 1, false);


--
-- TOC entry 5135 (class 0 OID 0)
-- Dependencies: 231
-- Name: avis_id_avis_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.avis_id_avis_seq', 1, false);


--
-- TOC entry 5136 (class 0 OID 0)
-- Dependencies: 223
-- Name: chaussure_id_chaussure_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.chaussure_id_chaussure_seq', 7, true);


--
-- TOC entry 5137 (class 0 OID 0)
-- Dependencies: 219
-- Name: client_id_client_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.client_id_client_seq', 1, true);


--
-- TOC entry 5138 (class 0 OID 0)
-- Dependencies: 227
-- Name: commande_id_commande_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.commande_id_commande_seq', 1, true);


--
-- TOC entry 5139 (class 0 OID 0)
-- Dependencies: 229
-- Name: contenu_commande_id_contenu_commande_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.contenu_commande_id_contenu_commande_seq', 1, true);


--
-- TOC entry 5140 (class 0 OID 0)
-- Dependencies: 225
-- Name: info_pointure_id_info_pointure_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.info_pointure_id_info_pointure_seq', 2, true);


--
-- TOC entry 5141 (class 0 OID 0)
-- Dependencies: 233
-- Name: livraison_id_livraison_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.livraison_id_livraison_seq', 1, false);


--
-- TOC entry 4942 (class 2606 OID 25097)
-- Name: admin admin_login_key; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_login_key UNIQUE (login);


--
-- TOC entry 4944 (class 2606 OID 25095)
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id_admin);


--
-- TOC entry 4928 (class 2606 OID 24963)
-- Name: adresse adresse_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.adresse
    ADD CONSTRAINT adresse_pkey PRIMARY KEY (id_adresse);


--
-- TOC entry 4938 (class 2606 OID 25051)
-- Name: avis avis_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.avis
    ADD CONSTRAINT avis_pkey PRIMARY KEY (id_avis);


--
-- TOC entry 4930 (class 2606 OID 24981)
-- Name: chaussure chaussure_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.chaussure
    ADD CONSTRAINT chaussure_pkey PRIMARY KEY (id_chaussure);


--
-- TOC entry 4924 (class 2606 OID 24948)
-- Name: client client_email_key; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_email_key UNIQUE (email);


--
-- TOC entry 4926 (class 2606 OID 24946)
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id_client);


--
-- TOC entry 4934 (class 2606 OID 25011)
-- Name: commande commande_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_pkey PRIMARY KEY (id_commande);


--
-- TOC entry 4936 (class 2606 OID 25028)
-- Name: contenu_commande contenu_commande_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.contenu_commande
    ADD CONSTRAINT contenu_commande_pkey PRIMARY KEY (id_contenu_commande);


--
-- TOC entry 4932 (class 2606 OID 24993)
-- Name: info_pointure info_pointure_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.info_pointure
    ADD CONSTRAINT info_pointure_pkey PRIMARY KEY (id_info_pointure);


--
-- TOC entry 4940 (class 2606 OID 25073)
-- Name: livraison livraison_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.livraison
    ADD CONSTRAINT livraison_pkey PRIMARY KEY (id_livraison);


--
-- TOC entry 4945 (class 2606 OID 24964)
-- Name: adresse adresse_id_client_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.adresse
    ADD CONSTRAINT adresse_id_client_fkey FOREIGN KEY (id_client) REFERENCES public.client(id_client) ON DELETE CASCADE;


--
-- TOC entry 4950 (class 2606 OID 25057)
-- Name: avis avis_id_chaussure_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.avis
    ADD CONSTRAINT avis_id_chaussure_fkey FOREIGN KEY (id_chaussure) REFERENCES public.chaussure(id_chaussure) ON DELETE CASCADE;


--
-- TOC entry 4951 (class 2606 OID 25052)
-- Name: avis avis_id_client_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.avis
    ADD CONSTRAINT avis_id_client_fkey FOREIGN KEY (id_client) REFERENCES public.client(id_client) ON DELETE CASCADE;


--
-- TOC entry 4947 (class 2606 OID 25012)
-- Name: commande commande_id_client_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_id_client_fkey FOREIGN KEY (id_client) REFERENCES public.client(id_client) ON DELETE CASCADE;


--
-- TOC entry 4948 (class 2606 OID 25029)
-- Name: contenu_commande contenu_commande_id_commande_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.contenu_commande
    ADD CONSTRAINT contenu_commande_id_commande_fkey FOREIGN KEY (id_commande) REFERENCES public.commande(id_commande) ON DELETE CASCADE;


--
-- TOC entry 4949 (class 2606 OID 25034)
-- Name: contenu_commande contenu_commande_id_info_pointure_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.contenu_commande
    ADD CONSTRAINT contenu_commande_id_info_pointure_fkey FOREIGN KEY (id_info_pointure) REFERENCES public.info_pointure(id_info_pointure);


--
-- TOC entry 4946 (class 2606 OID 24994)
-- Name: info_pointure info_pointure_id_chaussure_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.info_pointure
    ADD CONSTRAINT info_pointure_id_chaussure_fkey FOREIGN KEY (id_chaussure) REFERENCES public.chaussure(id_chaussure) ON DELETE CASCADE;


--
-- TOC entry 4952 (class 2606 OID 25079)
-- Name: livraison livraison_id_adresse_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.livraison
    ADD CONSTRAINT livraison_id_adresse_fkey FOREIGN KEY (id_adresse) REFERENCES public.adresse(id_adresse);


--
-- TOC entry 4953 (class 2606 OID 25074)
-- Name: livraison livraison_id_commande_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.livraison
    ADD CONSTRAINT livraison_id_commande_fkey FOREIGN KEY (id_commande) REFERENCES public.commande(id_commande) ON DELETE CASCADE;


-- Completed on 2026-05-07 09:29:12

--
-- PostgreSQL database dump complete
--

\unrestrict hqT6Qpd5m71MB55MD4ceubznCv4y2ce4ujF932pamDeGKsAa0WtCdib22vK2NwD

