INSERT INTO pnvev_administrative_regions (name,forms_name,map_code) VALUES
	 ('Alto Paraguay','ALTO PARAGUAY','py-ag'),
	 ('Alto Parana','ALTO PARANA','py-aa'),
	 ('Amambay','AMAMBAY','py-am'),
	 ('Asunción','ASUNCION','py-as'),
	 ('Boqueron','BOQUERON','py-bq'),
	 ('Caaguazu','CAAGUAZU','py-cg'),
	 ('Caazapa','CAAZAPA','py-cz'),
	 ('Canindeyu','CANINDEYU','py-cy'),
	 ('Central','CENTRAL','py-ce'),
	 ('Concepcion','CONCEPCION','py-cn');
INSERT INTO pnvev_administrative_regions (name,forms_name,map_code) VALUES
	 ('Cordillera','CORDILLERA','py-cr'),
	 ('Extranjero','EXTRANJERO',NULL),
	 ('Guaira','GUAIRA','py-gu'),
	 ('Itapua','ITAPUA','py-it'),
	 ('Misiones','MISIONES','py-mi'),
	 ('Ñeembucu','ÑEEMBUCU','py-ne'),
	 ('Paraguari','PARAGUARI','py-pg'),
	 ('Presidente Hayes','PTE. HAYES','py-ph'),
	 ('San Pedro','SAN PEDRO','py-sp'),
	 ('Sin Datos','SIN DATOS',NULL);
INSERT INTO pnvev_age_groups (name,`order`,family) VALUES
	 ('<2',1,1),
	 ('2 a 4',2,1),
	 ('5 a 19',3,1),
	 ('20 a 39',4,1),
	 ('40 a 59',5,1),
	 ('60 y mas',6,1),
	 ('SD',7,1);
INSERT INTO pnvev_disease_v2s (parent_id,name,`level`,`order`,case_description,tendencies_title,children_tendencies_title,distribution_title,regions_heatmap_title,districts_heatmap_title) VALUES
	 (NULL,'Malaria','0',2,'Casos Importados','Casos Importados de Malaria','','Casos Importados de Malaria','Casos Importados de Malaria','Casos Importados de Malaria'),
	 (NULL,'Leishmaniasis','0',4,'Casos Confirmados','','','','',''),
	 (NULL,'Chagas','0',5,'Casos Confirmados','','','','',''),
	 (4,'Tegumentaria','1',1,'Casos Confirmados','Casos Confirmados de Leishmaniasis Tegumentaria','Casos Confirmados de Enfermedades Constituyentes','Casos Confirmados de Leishmaniasis Tegumentaria','Casos Confirmados de Leishmaniasis Tegumentaria','Casos Confirmados de Leishmaniasis Tegumentaria'),
	 (4,'Visceral','1',2,'Casos Confirmados','Casos Confirmados de Leishmaniasis Visceral','','Casos Confirmados de Leishmaniasis Visceral','Casos Confirmados de Leishmaniasis Visceral','Casos Confirmados de Leishmaniasis Visceral'),
	 (6,'L. Mucosa','2',1,'Casos Confirmados','','','','',''),
	 (6,'L. Cutanea','2',2,'Casos Confirmados','','','','',''),
	 (5,'Agudo','1',1,'Casos Confirmados','Casos Confirmados de Chagas Agudo','Casos Confirmados de Enfermedades Constituyentes','Casos Confirmados de Chagas Agudo','Casos Confirmados de Chagas Agudo','Casos Confirmados de Chagas Agudo'),
	 (5,'Cronico','1',2,'Casos Confirmados','Casos Confirmados de Chagas Agudo','','Casos Confirmados de Chagas Agudo','Casos Confirmados de Chagas Agudo','Casos Confirmados de Chagas Agudo'),
	 (10,'C. Connatal','2',1,'Casos Confirmados','','','','','');
INSERT INTO pnvev_disease_v2s (parent_id,name,`level`,`order`,case_description,tendencies_title,children_tendencies_title,distribution_title,regions_heatmap_title,districts_heatmap_title) VALUES
	 (10,'C. Vectorial','2',2,'Casos Confirmados','','','','',''),
	 (10,'C. Transfusional','2',3,'Casos Confirmados','','','','',''),
	 (10,'C. Oral','2',4,'Casos Confirmados','','','','',''),
	 (NULL,'Fiebre Amarilla','0',6,'Casos Confirmados','','','','',''),
	 (16,'Confirmados','1',1,'Casos Confirmados','Casos Confirmados de Fiebre Amarilla','','Casos Confirmados de Fiebre Amarilla','Casos Confirmados de Fiebre Amarilla','Casos Confirmados de Fiebre Amarilla'),
	 (16,'Notificaciones','1',2,'Casos Notificados','Casos Notificados de Fiebre Amarilla','','Casos Notificados de Fiebre Amarilla','Casos Notificados de Fiebre Amarilla','Casos Notificados de Fiebre Amarilla');
INSERT INTO pnvev_epiweek (SemanaEpidemiologica,Inicio,Fin) VALUES
	 (1,'2022-01-02','2022-01-08'),
	 (2,'2022-01-09','2022-01-15'),
	 (3,'2022-01-16','2022-01-22'),
	 (4,'2022-01-23','2022-01-29'),
	 (5,'2022-01-30','2022-02-05'),
	 (6,'2022-02-06','2022-02-12'),
	 (7,'2022-02-13','2022-02-19'),
	 (8,'2022-02-20','2022-02-26'),
	 (9,'2022-02-27','2022-03-05'),
	 (10,'2022-03-06','2022-03-12');
INSERT INTO pnvev_epiweek (SemanaEpidemiologica,Inicio,Fin) VALUES
	 (11,'2022-03-13','2022-03-19'),
	 (12,'2022-03-20','2022-03-26'),
	 (13,'2022-03-27','2022-04-02'),
	 (14,'2022-04-03','2022-04-09'),
	 (15,'2022-04-10','2022-04-16'),
	 (16,'2022-04-17','2022-04-23'),
	 (17,'2022-04-24','2022-04-30'),
	 (18,'2022-05-01','2022-05-07'),
	 (19,'2022-05-08','2022-05-14'),
	 (20,'2022-05-15','2022-05-21');
INSERT INTO pnvev_epiweek (SemanaEpidemiologica,Inicio,Fin) VALUES
	 (21,'2022-05-22','2022-05-28'),
	 (22,'2022-05-29','2022-06-04'),
	 (23,'2022-06-05','2022-06-11'),
	 (24,'2022-06-12','2022-06-18'),
	 (25,'2022-06-19','2022-06-25'),
	 (26,'2022-06-26','2022-07-02'),
	 (27,'2022-07-03','2022-07-09'),
	 (28,'2022-07-10','2022-07-16'),
	 (29,'2022-07-17','2022-07-23'),
	 (30,'2022-07-24','2022-07-30');
INSERT INTO pnvev_epiweek (SemanaEpidemiologica,Inicio,Fin) VALUES
	 (31,'2022-07-31','2022-08-06'),
	 (32,'2022-08-07','2022-08-13'),
	 (33,'2022-08-14','2022-08-20'),
	 (34,'2022-08-21','2022-08-27'),
	 (35,'2022-08-28','2022-09-03'),
	 (36,'2022-09-04','2022-09-10'),
	 (37,'2022-09-11','2022-09-17'),
	 (38,'2022-09-18','2022-09-24'),
	 (39,'2022-09-25','2022-10-01'),
	 (40,'2022-10-02','2022-10-08');
INSERT INTO pnvev_epiweek (SemanaEpidemiologica,Inicio,Fin) VALUES
	 (41,'2022-10-09','2022-10-15'),
	 (42,'2022-10-16','2022-10-22'),
	 (43,'2022-10-23','2022-10-29'),
	 (44,'2022-10-30','2022-11-05'),
	 (45,'2022-11-06','2022-11-12'),
	 (46,'2022-11-13','2022-11-19'),
	 (47,'2022-11-20','2022-11-26'),
	 (48,'2022-11-27','2022-12-03'),
	 (49,'2022-12-04','2022-12-10'),
	 (50,'2022-12-11','2022-12-17');
INSERT INTO pnvev_epiweek (SemanaEpidemiologica,Inicio,Fin) VALUES
	 (51,'2022-12-18','2022-12-24'),
	 (52,'2022-12-25','2022-12-31'),
	 (53,'2023-01-01','2023-01-07'),
	 (0,'0000-00-00','0000-00-00'),
	 (1,'2022-01-02','2022-01-08'),
	 (2,'2022-01-09','2022-01-15'),
	 (3,'2022-01-16','2022-01-22'),
	 (4,'2022-01-23','2022-01-29'),
	 (5,'2022-01-30','2022-02-05'),
	 (6,'2022-02-06','2022-02-12');
INSERT INTO pnvev_epiweek (SemanaEpidemiologica,Inicio,Fin) VALUES
	 (7,'2022-02-13','2022-02-19'),
	 (8,'2022-02-20','2022-02-26'),
	 (9,'2022-02-27','2022-03-05'),
	 (10,'2022-03-06','2022-03-12'),
	 (11,'2022-03-13','2022-03-19'),
	 (12,'2022-03-20','2022-03-26'),
	 (13,'2022-03-27','2022-04-02'),
	 (14,'2022-04-03','2022-04-09'),
	 (15,'2022-04-10','2022-04-16'),
	 (16,'2022-04-17','2022-04-23');
INSERT INTO pnvev_epiweek (SemanaEpidemiologica,Inicio,Fin) VALUES
	 (17,'2022-04-24','2022-04-30'),
	 (18,'2022-05-01','2022-05-07'),
	 (19,'2022-05-08','2022-05-14'),
	 (20,'2022-05-15','2022-05-21'),
	 (21,'2022-05-22','2022-05-28'),
	 (22,'2022-05-29','2022-06-04'),
	 (23,'2022-06-05','2022-06-11'),
	 (24,'2022-06-12','2022-06-18'),
	 (25,'2022-06-19','2022-06-25'),
	 (26,'2022-06-26','2022-07-02');
INSERT INTO pnvev_epiweek (SemanaEpidemiologica,Inicio,Fin) VALUES
	 (27,'2022-07-03','2022-07-09'),
	 (28,'2022-07-10','2022-07-16'),
	 (29,'2022-07-17','2022-07-23'),
	 (30,'2022-07-24','2022-07-30'),
	 (31,'2022-07-31','2022-08-06'),
	 (32,'2022-08-07','2022-08-13'),
	 (33,'2022-08-14','2022-08-20'),
	 (34,'2022-08-21','2022-08-27'),
	 (35,'2022-08-28','2022-09-03'),
	 (36,'2022-09-04','2022-09-10');
INSERT INTO pnvev_epiweek (SemanaEpidemiologica,Inicio,Fin) VALUES
	 (37,'2022-09-11','2022-09-17'),
	 (38,'2022-09-18','2022-09-24'),
	 (39,'2022-09-25','2022-10-01'),
	 (40,'2022-10-02','2022-10-08'),
	 (41,'2022-10-09','2022-10-15'),
	 (42,'2022-10-16','2022-10-22'),
	 (43,'2022-10-23','2022-10-29'),
	 (44,'2022-10-30','2022-11-05'),
	 (45,'2022-11-06','2022-11-12'),
	 (46,'2022-11-13','2022-11-19');
INSERT INTO pnvev_epiweek (SemanaEpidemiologica,Inicio,Fin) VALUES
	 (47,'2022-11-20','2022-11-26'),
	 (48,'2022-11-27','2022-12-03'),
	 (49,'2022-12-04','2022-12-10'),
	 (50,'2022-12-11','2022-12-17'),
	 (51,'2022-12-18','2022-12-24'),
	 (52,'2022-12-25','2022-12-31'),
	 (53,'2023-01-01','2023-01-07'),
	 (0,'0000-00-00','0000-00-00');
INSERT INTO pnvev_genders (name,`order`) VALUES
	 ('Masculino',1),
	 ('Femenino',2),
	 ('SD',3);
INSERT INTO pnvev_users (name,email,password,remember_token,created_at,updated_at) VALUES
	 ('Administrator','admin','$2y$10$T5yoKyE5soVeKn0I5St0y.L.gtZkwajVGcqzeiiADcGJvHOY4/YZG',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');
