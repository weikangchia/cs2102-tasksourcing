--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.4
-- Dumped by pg_dump version 9.5.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: category; Type: TABLE; Schema: public; Owner: forge
--

CREATE TABLE category (
    id integer NOT NULL,
    name character varying(64) NOT NULL,
    description character varying(120) NOT NULL,
    avartar character varying(120)
);


ALTER TABLE category OWNER TO forge;

--
-- Name: category_id_seq; Type: SEQUENCE; Schema: public; Owner: forge
--

CREATE SEQUENCE category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE category_id_seq OWNER TO forge;

--
-- Name: category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: forge
--

ALTER SEQUENCE category_id_seq OWNED BY category.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: forge
--

CREATE TABLE users (
    id integer NOT NULL,
    username character varying(16) NOT NULL,
    email character varying(120) NOT NULL,
    password character varying(64) NOT NULL,
    first_name character varying(32),
    last_name character varying(32),
    avatar character varying(120),
    reputation integer DEFAULT 0 NOT NULL,
    created_at date NOT NULL,
    bio character varying(120),
    remember_token character varying(120),
    updated_at date,
    role integer NOT NULL,
    CONSTRAINT users_len_username CHECK ((length((username)::text) >= 5))
);


ALTER TABLE users OWNER TO forge;

--
-- Name: member_uid_seq; Type: SEQUENCE; Schema: public; Owner: forge
--

CREATE SEQUENCE member_uid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE member_uid_seq OWNER TO forge;

--
-- Name: member_uid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: forge
--

ALTER SEQUENCE member_uid_seq OWNED BY users.id;


--
-- Name: task; Type: TABLE; Schema: public; Owner: forge
--

CREATE TABLE task (
    task_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    category character varying(255)
);


ALTER TABLE task OWNER TO forge;

--
-- Name: task_name_seq; Type: SEQUENCE; Schema: public; Owner: forge
--

CREATE SEQUENCE task_name_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE task_name_seq OWNER TO forge;

--
-- Name: task_name_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: forge
--

ALTER SEQUENCE task_name_seq OWNED BY task.name;


--
-- Name: task_task_id_seq; Type: SEQUENCE; Schema: public; Owner: forge
--

CREATE SEQUENCE task_task_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE task_task_id_seq OWNER TO forge;

--
-- Name: task_task_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: forge
--

ALTER SEQUENCE task_task_id_seq OWNED BY task.task_id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: forge
--

ALTER TABLE ONLY category ALTER COLUMN id SET DEFAULT nextval('category_id_seq'::regclass);


--
-- Name: task_id; Type: DEFAULT; Schema: public; Owner: forge
--

ALTER TABLE ONLY task ALTER COLUMN task_id SET DEFAULT nextval('task_task_id_seq'::regclass);


--
-- Name: name; Type: DEFAULT; Schema: public; Owner: forge
--

ALTER TABLE ONLY task ALTER COLUMN name SET DEFAULT nextval('task_name_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: forge
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('member_uid_seq'::regclass);


--
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: forge
--

COPY category (id, name, description, avartar) FROM stdin;
3	Cleaning	House cleaning, office cleaning, spring cleaning and etc.	\N
4	Fix Stuff	Furniture assembly, appliance repair, TV mounting and installation and etc.	\N
2	Delivery and Removals	Furniture delivery, food Delivery, fridge moving and removal etc.	\N
1	Everything Else	Event help, queue line up, and anything that doesn't fit into either category.	\N
\.


--
-- Name: category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: forge
--

SELECT pg_catalog.setval('category_id_seq', 4, true);


--
-- Name: member_uid_seq; Type: SEQUENCE SET; Schema: public; Owner: forge
--

SELECT pg_catalog.setval('member_uid_seq', 45, true);


--
-- Data for Name: task; Type: TABLE DATA; Schema: public; Owner: forge
--

COPY task (task_id, name, category) FROM stdin;
1	Clean your house	General Cleaning
2	Run your errands	Delivery & Shopping
3	Pack your boxes	Book Moving
4	Pack your boxes 1	Book Moving
\.


--
-- Name: task_name_seq; Type: SEQUENCE SET; Schema: public; Owner: forge
--

SELECT pg_catalog.setval('task_name_seq', 1, false);


--
-- Name: task_task_id_seq; Type: SEQUENCE SET; Schema: public; Owner: forge
--

SELECT pg_catalog.setval('task_task_id_seq', 4, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: forge
--

COPY users (id, username, email, password, first_name, last_name, avatar, reputation, created_at, bio, remember_token, updated_at, role) FROM stdin;
12	david	david@mailinator.com	$2y$10$2rgA.b551n8Dj4Jmh3HtfOWJgr/xsep81d.lH4l03KUu9hAHnM3Hu	\N	\N	\N	0	2016-09-22	\N	\N	2016-09-22	0
37	jacky	jacky@mailinator.com	$2y$10$bd7zfeucrFgQW.z41XACZe9jUXhZ8TlYQvU2pPOR5b4zStZ4nqS6C	\N	\N	\N	0	2016-09-22	\N	MnvzdiErFY52RnUPZaQxO4VwONH1MT8386ax5PEqYkWP7HwIxUq6s2gthFwA	2016-09-22	0
38	weihan	weihan@mailinator.com	$2y$10$DAnRSCC5YQ2byDfM4mXbPOrpyqv7hZgVxkpQzvPItqEIAyumlvvMO	Wei Han	Chia	\N	0	2016-09-27	I am very helpful.	\N	2016-09-27	0
13	admin	admin@mailinator.com	$2y$10$gMEsy4Qz3/fKJPiPNeRdUehhZL7mKjhcrMEYcEGbEei4fDSjlYF26	\N	\N	\N	0	2016-09-22	\N	ICMDDR8q85dE0BOMYvcU116rIyoJvxv1G2cSnLSO6amcvAe59DFrpB9fOvU1	2016-09-22	1
11	weikangchia	weikangchia@mailinator.com	$2y$10$fsVRL3kQELehItkhsfKsR.cFYj10Aclh7xYYX9Lvf3DUVRPuu53CW	Wei Kang	Chia	\N	0	2016-09-22	\N	40jGHBbsIbigHKuBTmqMoUBFrDItjpN7ZNuNJdKtoZ2AWozKDgPX7XQe76Z0	2016-10-07	0
45	mary.lim	mary.lim@mailinator.com	$2y$10$aOmTOXnr0cY9pq84GzbQqejsKnmAu.EO/XbVh6ORH9tapiVxY1k2S	Mary	Lim	\N	0	2016-10-07	Hi. I am a helpful person.	\N	2016-10-07	0
\.


--
-- Name: category_name_key; Type: CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY category
    ADD CONSTRAINT category_name_key UNIQUE (name);


--
-- Name: category_pkey; Type: CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY category
    ADD CONSTRAINT category_pkey PRIMARY KEY (id);


--
-- Name: task_pkey; Type: CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY task
    ADD CONSTRAINT task_pkey PRIMARY KEY (task_id);


--
-- Name: users_primary_key; Type: CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_primary_key PRIMARY KEY (id);


--
-- Name: users_unique_email; Type: CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_unique_email UNIQUE (email);


--
-- Name: users_unique_username; Type: CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_unique_username UNIQUE (username);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;
GRANT ALL ON SCHEMA public TO forge;


--
-- PostgreSQL database dump complete
--

