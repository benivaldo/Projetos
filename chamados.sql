--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.1
-- Dumped by pg_dump version 9.6.1

-- Started on 2017-04-16 09:33:20

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE chamados;
--
-- TOC entry 2153 (class 1262 OID 25281)
-- Name: chamados; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE chamados WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'C' LC_CTYPE = 'C';


ALTER DATABASE chamados OWNER TO postgres;

\connect chamados

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12387)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2155 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 186 (class 1259 OID 25284)
-- Name: chamados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE chamados (
    id integer NOT NULL,
    clienteid integer,
    pedidoid integer,
    titulo character varying(50),
    email character varying(50),
    observacao character varying(50)
);


ALTER TABLE chamados OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 25282)
-- Name: chamados_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE chamados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE chamados_id_seq OWNER TO postgres;

--
-- TOC entry 2156 (class 0 OID 0)
-- Dependencies: 185
-- Name: chamados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE chamados_id_seq OWNED BY chamados.id;


--
-- TOC entry 188 (class 1259 OID 25295)
-- Name: clientes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE clientes (
    id integer NOT NULL,
    nome character varying(50),
    email character varying(50)
);


ALTER TABLE clientes OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 25293)
-- Name: clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE clientes_id_seq OWNER TO postgres;

--
-- TOC entry 2157 (class 0 OID 0)
-- Dependencies: 187
-- Name: clientes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE clientes_id_seq OWNED BY clientes.id;


--
-- TOC entry 190 (class 1259 OID 25303)
-- Name: pedidos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pedidos (
    id integer NOT NULL,
    descricao character varying(80)
);


ALTER TABLE pedidos OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 25301)
-- Name: pedidos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pedidos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pedidos_id_seq OWNER TO postgres;

--
-- TOC entry 2158 (class 0 OID 0)
-- Dependencies: 189
-- Name: pedidos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pedidos_id_seq OWNED BY pedidos.id;


--
-- TOC entry 2013 (class 2604 OID 25287)
-- Name: chamados id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY chamados ALTER COLUMN id SET DEFAULT nextval('chamados_id_seq'::regclass);


--
-- TOC entry 2014 (class 2604 OID 25298)
-- Name: clientes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY clientes ALTER COLUMN id SET DEFAULT nextval('clientes_id_seq'::regclass);


--
-- TOC entry 2015 (class 2604 OID 25306)
-- Name: pedidos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pedidos ALTER COLUMN id SET DEFAULT nextval('pedidos_id_seq'::regclass);


--
-- TOC entry 2144 (class 0 OID 25284)
-- Dependencies: 186
-- Data for Name: chamados; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO chamados VALUES (1, 13, 2, 'Titulo', 'daniel@email.com', 'Observação');
INSERT INTO chamados VALUES (2, 16, 8, 'Titulo', 'marcelo@email.com', 'Observação');
INSERT INTO chamados VALUES (3, 13, 10, 'Chamado 1', 'daniel@email.com', 'Observação');
INSERT INTO chamados VALUES (4, 13, 10, 'Chamado 1', 'daniel@email.com', 'Observação');
INSERT INTO chamados VALUES (5, 15, 4, 'Chamado 1', 'email@email.com', 'Observação');
INSERT INTO chamados VALUES (6, 1, 11, 'Chamado 1', 'jose@email.com', 'Observacao');
INSERT INTO chamados VALUES (7, 6, 9, 'Titulo 2', 'juliana@email.com', 'Observação');
INSERT INTO chamados VALUES (8, 7, 6, 'Chamado 1', 'mariana@email.com', 'Observação');
INSERT INTO chamados VALUES (9, 3, 7, 'Titulo', 'maria@email.com', 'Observação');
INSERT INTO chamados VALUES (10, 2, 13, 'Titulo', 'antonio@email.com', 'Observacao');
INSERT INTO chamados VALUES (11, 18, 14, 'Chamado 14', 'josiane@email.com', 'Observação');
INSERT INTO chamados VALUES (12, 19, 12, 'Chamado 12', 'rafale@email.com', 'Observação');
INSERT INTO chamados VALUES (13, 20, 15, 'Chamado 15', 'claudia@email.com', 'Observação');


--
-- TOC entry 2159 (class 0 OID 0)
-- Dependencies: 185
-- Name: chamados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('chamados_id_seq', 13, true);


--
-- TOC entry 2146 (class 0 OID 25295)
-- Dependencies: 188
-- Data for Name: clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO clientes VALUES (1, 'José', 'jose@email.com');
INSERT INTO clientes VALUES (2, 'Antonio', 'antonio@email.com');
INSERT INTO clientes VALUES (3, 'Maria', 'maria@email.com');
INSERT INTO clientes VALUES (4, 'Fernando', 'feranado@email.com');
INSERT INTO clientes VALUES (5, 'Júlio', 'julio@email.com');
INSERT INTO clientes VALUES (6, 'Juliana', 'juliana@email.com');
INSERT INTO clientes VALUES (7, 'Mariana', 'mariana@email.com');
INSERT INTO clientes VALUES (8, 'Cláudio', 'claudio@email.com');
INSERT INTO clientes VALUES (9, 'Alberto', 'alberto@email.com');
INSERT INTO clientes VALUES (10, 'Marcos', 'marcos@email.com');
INSERT INTO clientes VALUES (11, 'Rafael', 'rafael@email.com');
INSERT INTO clientes VALUES (12, 'Paulo', 'paulo@email.com');
INSERT INTO clientes VALUES (13, 'Daniel', 'daniel@email.com');
INSERT INTO clientes VALUES (14, 'Daniel', 'danil@email.com');
INSERT INTO clientes VALUES (15, 'Daniel', 'email@email.com');
INSERT INTO clientes VALUES (16, 'Marcelo', 'marcelo@email.com');
INSERT INTO clientes VALUES (17, 'Danilo', 'danilo@email.com');
INSERT INTO clientes VALUES (18, 'Josiane', 'josiane@email.com');
INSERT INTO clientes VALUES (19, 'Rafaela', 'rafaela@email.com');
INSERT INTO clientes VALUES (20, 'Cláudia', 'claudia@email.com');


--
-- TOC entry 2160 (class 0 OID 0)
-- Dependencies: 187
-- Name: clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('clientes_id_seq', 20, true);


--
-- TOC entry 2148 (class 0 OID 25303)
-- Dependencies: 190
-- Data for Name: pedidos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO pedidos VALUES (1, 'Pedido 1');
INSERT INTO pedidos VALUES (2, 'Pedido 2');
INSERT INTO pedidos VALUES (3, 'Pedido 3');
INSERT INTO pedidos VALUES (4, 'Pedido 4');
INSERT INTO pedidos VALUES (5, 'Pedido 5');
INSERT INTO pedidos VALUES (6, 'Pedido 6');
INSERT INTO pedidos VALUES (7, 'Pedido 7');
INSERT INTO pedidos VALUES (8, 'Pedido 8');
INSERT INTO pedidos VALUES (9, 'Pedido 9');
INSERT INTO pedidos VALUES (10, 'Pedido 10');
INSERT INTO pedidos VALUES (11, 'Pedido 11');
INSERT INTO pedidos VALUES (12, 'Pedido 12');
INSERT INTO pedidos VALUES (13, 'Pedido 13');
INSERT INTO pedidos VALUES (14, 'Pedido 14');
INSERT INTO pedidos VALUES (15, 'Pedido 15');
INSERT INTO pedidos VALUES (16, 'Pedido 16');


--
-- TOC entry 2161 (class 0 OID 0)
-- Dependencies: 189
-- Name: pedidos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pedidos_id_seq', 16, true);


--
-- TOC entry 2017 (class 2606 OID 25292)
-- Name: chamados chamados_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY chamados
    ADD CONSTRAINT chamados_pkey PRIMARY KEY (id);


--
-- TOC entry 2019 (class 2606 OID 25357)
-- Name: clientes clientes_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY clientes
    ADD CONSTRAINT clientes_email_key UNIQUE (email);


--
-- TOC entry 2021 (class 2606 OID 25300)
-- Name: clientes clientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id);


--
-- TOC entry 2023 (class 2606 OID 25310)
-- Name: pedidos pedidos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pedidos
    ADD CONSTRAINT pedidos_pkey PRIMARY KEY (id);


--
-- TOC entry 2024 (class 2606 OID 25316)
-- Name: chamados chamados_clientes; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY chamados
    ADD CONSTRAINT chamados_clientes FOREIGN KEY (clienteid) REFERENCES clientes(id);


--
-- TOC entry 2025 (class 2606 OID 25321)
-- Name: chamados chamados_pedidoid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY chamados
    ADD CONSTRAINT chamados_pedidoid_fkey FOREIGN KEY (pedidoid) REFERENCES pedidos(id);


-- Completed on 2017-04-16 09:33:20

--
-- PostgreSQL database dump complete
--

