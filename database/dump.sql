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
-- Name: bid; Type: TABLE; Schema: public; Owner: forge
--

CREATE TABLE bid (
    status character varying DEFAULT 'pending'::character varying NOT NULL,
    created_at date NOT NULL,
    id integer NOT NULL,
    bid_amount double precision NOT NULL,
    u_id integer NOT NULL,
    t_id integer NOT NULL
);


ALTER TABLE bid OWNER TO forge;

--
-- Name: bid_id_seq; Type: SEQUENCE; Schema: public; Owner: forge
--

CREATE SEQUENCE bid_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE bid_id_seq OWNER TO forge;

--
-- Name: bid_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: forge
--

ALTER SEQUENCE bid_id_seq OWNED BY bid.id;


--
-- Name: category; Type: TABLE; Schema: public; Owner: forge
--

CREATE TABLE category (
    id integer NOT NULL,
    name character varying(64) NOT NULL,
    description character varying(120) NOT NULL,
    category_photo character varying(120)
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
-- Name: comment; Type: TABLE; Schema: public; Owner: forge
--

CREATE TABLE comment (
    id integer NOT NULL,
    u_id integer NOT NULL,
    t_id integer NOT NULL,
    posted_date date NOT NULL,
    detail character varying(255) NOT NULL
);


ALTER TABLE comment OWNER TO forge;

--
-- Name: comment_id_seq; Type: SEQUENCE; Schema: public; Owner: forge
--

CREATE SEQUENCE comment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE comment_id_seq OWNER TO forge;

--
-- Name: comment_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: forge
--

ALTER SEQUENCE comment_id_seq OWNED BY comment.id;


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
    profile_photo character varying(120),
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
    id integer NOT NULL,
    name character varying(64) NOT NULL,
    postal_code integer,
    description character varying(255),
    created_at date,
    updated_at date,
    start_date date,
    start_time time without time zone,
    cash_value double precision,
    duration integer,
    category integer,
    posted_by integer,
    location character varying(120)
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

ALTER SEQUENCE task_task_id_seq OWNED BY task.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: forge
--

ALTER TABLE ONLY bid ALTER COLUMN id SET DEFAULT nextval('bid_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: forge
--

ALTER TABLE ONLY category ALTER COLUMN id SET DEFAULT nextval('category_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: forge
--

ALTER TABLE ONLY comment ALTER COLUMN id SET DEFAULT nextval('comment_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: forge
--

ALTER TABLE ONLY task ALTER COLUMN id SET DEFAULT nextval('task_task_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: forge
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('member_uid_seq'::regclass);


--
-- Data for Name: bid; Type: TABLE DATA; Schema: public; Owner: forge
--

COPY bid (status, created_at, id, bid_amount, u_id, t_id) FROM stdin;
pending	2016-10-19	3	30	45	5
rejected	2016-10-19	4	90	45	8
rejected	2016-09-09	1	20	38	8
\.


--
-- Name: bid_id_seq; Type: SEQUENCE SET; Schema: public; Owner: forge
--

SELECT pg_catalog.setval('bid_id_seq', 4, true);


--
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: forge
--

COPY category (id, name, description, category_photo) FROM stdin;
3	Cleaning	House cleaning, office cleaning, spring cleaning and etc.	cleaning.jpg
4	Fix Stuff	Furniture assembly, appliance repair, TV mounting and installation and etc.	fix_stuff.jpg
2	Delivery and Removals	Furniture delivery, food Delivery, fridge moving and removal etc.	delivery.jpg
1	Everything Else	Event help, queue line up, and anything that doesn't fit into either category.	general.jpg
\.


--
-- Name: category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: forge
--

SELECT pg_catalog.setval('category_id_seq', 4, true);


--
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: forge
--

COPY comment (id, u_id, t_id, posted_date, detail) FROM stdin;
1	11	5	2016-09-09	hello
2	11	5	2016-10-19	bye
3	11	5	2016-10-19	bye
4	11	8	2016-10-19	hello
\.


--
-- Name: comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: forge
--

SELECT pg_catalog.setval('comment_id_seq', 4, true);


--
-- Name: member_uid_seq; Type: SEQUENCE SET; Schema: public; Owner: forge
--

SELECT pg_catalog.setval('member_uid_seq', 45, true);


--
-- Data for Name: task; Type: TABLE DATA; Schema: public; Owner: forge
--

COPY task (id, name, postal_code, description, created_at, updated_at, start_date, start_time, cash_value, duration, category, posted_by, location) FROM stdin;
6	Deliver parcel	550534	I need help to deliver a parcel to my aunty house.	2016-09-22	2016-09-22	2016-09-22	15:00:00	8	60	1	11	Bishan
5	Wash car @NUS	119220	I need someone to help me wash my car.	2016-09-20	2016-10-16	2016-10-23	15:05:00	30	60	3	11	NUS
9	Deliver Groceries	120109	I need a dozen eggs, a loaf of whole grain bread, and a stick of butter.	2016-10-03	2016-10-03	2016-11-05	08:00:00	5	30	2	37	Clementi
10	Pick up luggage	400035	I need someone to pickup my luggage from outside my apartment and drop it off at the airport.	2016-10-16	2016-10-16	2016-11-04	21:00:00	30	120	2	37	Eunos
11	Mount TV	560328	I need a strong person to help me mount my TV to the wall.	2016-10-14	2016-10-14	2016-11-29	12:00:00	30	45	4	45	Ang Mo Kio
12	Furniture Assembly	640695	I need someone with good hands to help me assemble my furniture from IKEA.	2016-10-03	2016-10-03	2016-10-29	14:00:00	50	60	4	12	Jurong West
13	Manning a booth	138607	I need someone to be in charge of the booth and give people information on breast cancer.\t	2016-10-15	2016-10-15	2016-11-01	08:00:00	100	180	1	45	NUS UTown
14	Organize office supplies	760154	Organize our supplies onto shelves so that we can access them easily.	2016-10-08	2016-10-08	2016-11-02	10:30:00	60	60	1	37	Yishun
15	Shoe Cleaning	637820	I need my shoes cleaned.	2016-10-15	2016-10-15	2016-11-05	18:00:00	15	10	3	38	NTU
16	Fix table	380105	One of my table's legs is broken and I would like it fixed	2016-10-10	2016-10-10	2016-11-28	13:30:00	45	60	4	12	Geylang
8	Wash Van	550533	I need help to wash my van.	2016-10-16	2016-10-19	2016-11-16	15:00:00	20	60	3	11	Serangoon North
\.


--
-- Name: task_name_seq; Type: SEQUENCE SET; Schema: public; Owner: forge
--

SELECT pg_catalog.setval('task_name_seq', 1, false);


--
-- Name: task_task_id_seq; Type: SEQUENCE SET; Schema: public; Owner: forge
--

SELECT pg_catalog.setval('task_task_id_seq', 16, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: forge
--

COPY users (id, username, email, password, first_name, last_name, profile_photo, reputation, created_at, bio, remember_token, updated_at, role) FROM stdin;
12	david	david@mailinator.com	$2y$10$2rgA.b551n8Dj4Jmh3HtfOWJgr/xsep81d.lH4l03KUu9hAHnM3Hu	\N	\N	\N	0	2016-09-22	\N	\N	2016-09-22	0
37	jacky	jacky@mailinator.com	$2y$10$bd7zfeucrFgQW.z41XACZe9jUXhZ8TlYQvU2pPOR5b4zStZ4nqS6C	\N	\N	\N	0	2016-09-22	\N	MnvzdiErFY52RnUPZaQxO4VwONH1MT8386ax5PEqYkWP7HwIxUq6s2gthFwA	2016-09-22	0
11	weikangchia	weikangchia@mailinator.com	$2y$10$fsVRL3kQELehItkhsfKsR.cFYj10Aclh7xYYX9Lvf3DUVRPuu53CW	Wei Kang	Chia	11.png	0	2016-09-22	Android and Web programmer	40jGHBbsIbigHKuBTmqMoUBFrDItjpN7ZNuNJdKtoZ2AWozKDgPX7XQe76Z0	2016-10-19	0
38	weihan	weihan@mailinator.com	$2y$10$DAnRSCC5YQ2byDfM4mXbPOrpyqv7hZgVxkpQzvPItqEIAyumlvvMO	Wei Han	Chia	\N	0	2016-09-27	I am very helpful.	\N	2016-10-19	0
45	mary.lim	mary.lim@mailinator.com	$2y$10$aOmTOXnr0cY9pq84GzbQqejsKnmAu.EO/XbVh6ORH9tapiVxY1k2S	Mary	Lim	\N	0	2016-10-07	Hi. I am a helpful person.	\N	2016-10-19	0
13	admin	admin@mailinator.com	$2y$10$gMEsy4Qz3/fKJPiPNeRdUehhZL7mKjhcrMEYcEGbEei4fDSjlYF26	\N	\N	13.png	0	2016-09-22	\N	ICMDDR8q85dE0BOMYvcU116rIyoJvxv1G2cSnLSO6amcvAe59DFrpB9fOvU1	2016-10-19	1
\.


--
-- Name: bid_pkey; Type: CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY bid
    ADD CONSTRAINT bid_pkey PRIMARY KEY (id, u_id, t_id);


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
-- Name: comment_pkey; Type: CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT comment_pkey PRIMARY KEY (id, u_id, t_id);


--
-- Name: task_pkey; Type: CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY task
    ADD CONSTRAINT task_pkey PRIMARY KEY (id);


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
-- Name: bid_t_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY bid
    ADD CONSTRAINT bid_t_id_fkey FOREIGN KEY (t_id) REFERENCES task(id) ON DELETE CASCADE;


--
-- Name: bid_u_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY bid
    ADD CONSTRAINT bid_u_id_fkey FOREIGN KEY (u_id) REFERENCES users(id) ON DELETE CASCADE;


--
-- Name: comment_t_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT comment_t_id_fkey FOREIGN KEY (t_id) REFERENCES task(id) ON DELETE CASCADE;


--
-- Name: comment_u_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT comment_u_id_fkey FOREIGN KEY (u_id) REFERENCES users(id) ON DELETE CASCADE;


--
-- Name: task_c.id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY task
    ADD CONSTRAINT "task_c.id_fkey" FOREIGN KEY (category) REFERENCES category(id) MATCH FULL ON DELETE CASCADE;


--
-- Name: task_u.id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: forge
--

ALTER TABLE ONLY task
    ADD CONSTRAINT "task_u.id_fkey" FOREIGN KEY (posted_by) REFERENCES users(id) MATCH FULL ON DELETE CASCADE;


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

