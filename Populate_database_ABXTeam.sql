-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
-- Server version: 10.3.27
-- PHP Version: 7.2.22
-- Student number: 100566816 

-- Dumping data for table `HAS_ACCEPTED`
INSERT INTO `HAS_ACCEPTED` (`Username`, `Request_ID`, `Acceptance_Status`, `Phials_Committed_To_Donate`) VALUES
('EvanBradley', 2068, 'Cancelled', 1),
('EvanBradley', 2053, 'Accepted', 1),
('EvanBradley', 2059, 'Donated', 1),
('EvanBradley', 2060, 'Accepted', 2),
('AnnaBella', 2067, 'Donated', 1),
('AndrewBrown', 2057, 'Donated', 2),
('JasonCooper', 2051, 'Donated', 1),
('JasonCooper', 2052, 'Cancelled', 1),
('AlyssaBell', 2062, 'Donated', 6),
('JasonCooper', 2050, 'Donated', 2),
('AndrewBrown', 2059, 'Cancelled', 1);
-- ----------------------------------------------------------------------------------------------------------------

-- Dumping data for table `HOSPITAL`
INSERT INTO `HOSPITAL` (`Hospital_ID`, `Hospital_Name`, `Hospital_Address`, `Hospital_City`, `Hospital_Prefecture`, `Donation_Service_Phone`) VALUES
(1001, 'Theagenio Cancer Hospital of Thessaloniki', 'Alexandrou Symeonidis 2, 546 39', 'Thessaloniki', 'Thessaloniki', '23108 98264'),
(1002, 'Metaxa Cancer Hospital of Piraeus', 'Mpotasi 51, 185 37', 'Athens', 'Attica', '210 4511459'),
(1003, 'General Hospital of Agios Nikolaos', 'Knosou 4, 721 00', 'Agios Nikolaos', 'Lasithi', '28413 43537'),
(1004, 'General Hospital of Agrinio', '3rd km of the National Road Agrinio-Antirrio, 301 32', 'Agrinio', 'Aetolia-Acarnania', '26410 46666'),
(1005, 'General Hospital of Athens Alexandra', '80 Vasilissis Sofias Avenue, 115 28', 'Athens', 'Attica', '210 7780300'),
(1006, 'General Hospital of Athens Gennimata', 'Avenue Mesogeion 154, 115 27', 'Athens', 'Attica', '213 2088248'),
(1007, 'General Hospital of Athens Evangelismos', 'Ypsilandou 45-47, 106 76', 'Athens', 'Attica', '213 2041391'),
(1008, 'General Hospital of Athens ELPIS', 'Dimitsanas 7, 115 22', 'Athens', 'Attica', '213 2039016'),
(1009, 'General Hospital of Athens IPPOKRATIO', 'Vasilissis Sofias 114, 115 27', 'Athens', 'Attica', '213 2088161'),
(1010, 'General Hospital of Athens KAT', 'Nikis 2, 145 61', 'Athens', 'Attica', '213 2086202'),
(1011, 'General Hospital of Athens Korgialenio - Benakio', 'Athanasaki 2, 115 26', 'Athens', 'Attica', '213 2068782'),
(1012, 'General Hospital of Aigio', 'Ano Voulomeno Aigio, 251 00', 'Aigio', 'Achaea', '26910 59456'),
(1013, 'General Hospital of Amaliada', 'Evaggelistrias 128, 272 00', 'Amaliada', 'Elis', '26223 60228'),
(1014, 'General Hospital of Amfissa', '112i, Amfissa, 331 00', 'Amfissa', 'Phocis', '22650 29605'),
(1015, 'General Hospital of Argos', 'Korinthou 191, 212 31', 'Argos', 'Argolis', '27510 67858'),
(1016, 'General Hospital of Arta', 'Unnamed Road, 471 00', 'Arta', 'Arta', '26813 61174'),
(1017, 'General Hospital of Attica Sismanogleio', 'Sismanogliou 1, 151 26', 'Athens', 'Attica', '213 2058495'),
(1018, 'General Hospital of Veria', 'Papagou settlement, 591 00', 'Veria', 'Imathia', '23313 51173'),
(1019, 'General Hospital of Voula', 'Leof. Vasileos Pavlou, 166 73', 'Voula', 'Attica', '213 8923181'),
(1020, 'General Hospital of Giannitsa', 'Giannitsa Province, 581 00', 'Giannitsa', 'Pella', '23823 50330'),
(1021, 'General Hospital of Grevena', 'Perioxi Stratopedou, 511 00', 'Grevena', 'Grevena', '24623 50330'),
(1022, 'General Hospital of Didymoteicho', '25is Maiou 152, 683 00', 'Didymoteicho', 'Thrace', '25533 50177'),
(1023, 'General Hospital of Drama', 'Hippocrates end, 661 32', 'Drama', 'Drama', '25213 50341'),
(1024, 'General Hospital of Edessa', 'End of Egnatia, 582 00', 'Edessa', 'Pella', '23810 22589'),
(1025, 'General Hospital of Elefsina', 'Georgiou Gennimata Avenue, 190 18', 'Eleusis', 'Attica', '213 2028737'),
(1026, 'General Hospital of Zakynthos', 'Zakinthos, 291 00', 'Zakynthos', 'Zakynthos', '26953 60522'),
(1027, 'General Hospital of Heraklion - Venizelio', 'Leof. Knosou 44, 714 09', 'Heraklion', 'Heraklion', '28134 08047'),
(1028, 'General Hospital of Thessaloniki Agios Pavlos', 'Avenue Ethnikis Antistaseos 161, 551 34', 'Thessaloniki', 'Thessaloniki', '23133 04580'),
(1029, 'General Hospital of Thessaloniki Ippokratio', 'Konstantinoupoleos 49, 54 642', 'Thessaloniki', 'Thessaloniki', '23133 12811'),
(1030, 'General Hospital of Thessaloniki Papanikolaou', 'Leof. Papanikolaou, 570 10', 'Thessaloniki', 'Thessaloniki', '23133 07015'),
(1031, 'General Hospital of Ioannina Chatzikosta', 'Leof. Str. Makrigianni 60, 454 45', 'Ioannina', 'Ioannina', '26510 80425'),
(1032, 'General Hospital of Kavala', 'Agios Syllas, 655 00', 'Kavala', 'Kavala', '25135 01868'),
(1033, 'General Hospital of Kalamata', 'Athens 99, 241 34', 'Kalamata', 'Messenia', '27213 63153'),
(1034, 'General Hospital of Kalymnos', 'Nikiforoi Zervou 22, 852 00', 'Kalymnos', 'Kalymnos', '22433 61946'),
(1035, 'General Hospital of Karditsa', 'Terma Tauropou, 431 00', 'Karditsa', 'Karditsa', '24413 5126'),
(1036, 'General Hospital of Kastoria', 'Mauriotissis 33, 521 00', 'Kastoria', 'Kastoria', '24673 50645'),
(1037, 'General Hospital of Katerini', '6th km of Katerini Arona, 601 00', 'Katerini', 'Pieria', '23513 52953'),
(1038, 'General Hospital of Corfu', 'Kontokali, 491 00', 'Corfu', 'Corfu', '26613 60512'),
(1039, 'General Hospital of Kefalonia', 'Souidias, 281 00', 'Argostolion', 'Cephalonia', '26710 38057'),
(1040, 'General Hospital of Kilkis', 'Hospital 1, 611 00', 'Kilkis', 'Kilkis', '23413 51723'),
(1041, 'General Hospital of Kozani ', 'Konstantinos Mamatsiou 1, 501 31', 'Kozani', 'Kozani', '24613 52642'),
(1042, 'General Hospital of Komotini', 'Ioannis Sismanoglou 45, 691 33', 'Komotini', 'Rodopi', '25313 51533'),
(1043, 'General Hospital of Corinth', 'Avenue 53 Athens, 201 00', 'Corinth', 'Corinth', '27413 61511'),
(1044, 'General Hospital of Kos', 'Ippokpatois 34, 853 00', 'Kos', 'Kos', '22420 23000'),
(1045, 'General Hospital of Larissa', 'Tsakalov 1, 412 21', 'Larissa', 'Larissa', '24102 34417'),
(1046, 'General Hospital of Lefkada', 'Philosophizer, 311 00', 'Lefkada', 'Lefkada', '26453 60160'),
(1047, 'General Hospital of Lemnos', 'Hephaestus 1, 814 00', 'Myrina', 'Lemnos', '22543 50461'),
(1048, 'General Hospital of Livadia', 'Agios Vlasios, 321 00', 'Livadia', 'Boeotia', '22610 84115'),
(1049, 'General Maternal Hospital of Athens "Elena Venizelou"', 'Square Elena Venizelou 2, 115 21', 'Athens', 'Attica', '210 6465467'),
(1050, 'General Hospital of Melission', '25es Martiou 14, 151 27', 'Athens', 'Attica', '210 8048950'),
(1051, 'General Hospital of Messolonghi', 'Nafpaktou 67, 302 00', 'Messolonghi', 'Aetolia-Acarnania', '26313 60140'),
(1052, 'General Hospital of Mytilene', 'Vostani Efstratiou 48, 811 32', 'Mitilini', 'Lesbos', '22513 51139'),
(1053, 'General Hospital of Naoussa', 'Afon Lanara & F. Pechlivanou 3, 592 00', 'Naousa', 'Imathia', '23323 50200'),
(1054, 'General Hospital of Nea Ionia', 'Agia Olga 3-5, 142 33', 'Nea Ionia', 'Attica', '210 2752469'),
(1055, 'General Hospital of Nikaia Agios Panteleimon', 'Dimitriou Mantouvalos 3, 184 54', 'Athens', 'Attica', '213 2076248'),
(1056, 'General Hospital of Xanthi', 'Neapoli, 671 00', 'Xanthi', 'Thrace', '25413 51417'),
(1057, 'General Hospital of Patras Agios Andreas', 'Kalavrita 37, 263 35', 'Patra', 'Achaea', '2610 227071'),
(1058, 'General Hospital of Piraeus Tzaneio', 'Zanni & Afendouli, 185 36', 'Athens', 'Attica', '210 4592756'),
(1059, 'General Hospital of Preveza', 'Selefkeias 2, 481 00', 'Preveza', 'Preveza', '26823 61222'),
(1060, 'General Hospital of Ptolemaida', 'Kouri, 502 00', 'Ptolemaida', 'Kozani', '24630 53333'),
(1061, 'General Hospital of Pyrgos', 'Suntriada, 271 31', 'Pyrgos', 'Elis', '26210 82846'),
(1062, 'General Hospital of Rethymnon', 'Trantalidou 17, 741 00', 'Rethimno', 'Rethimno', '28310 87232'),
(1063, 'General Hospital of Rhodes', 'Christian Barnard 1, 851 33', 'Rhodes', 'Rhodes', '22413 60391'),
(1064, 'General Hospital of Samos', 'Syntagmatarxis Kefalopoulou 17, 831 00', 'Vathi Samos', 'Samos', '22730 83467'),
(1065, 'General Hospital of Serres', '3rd km of Serres-Drama, 621 00', 'Serres', 'Serres', '23210 94647'),
(1066, 'General Hospital of Sparta', 'Sparta, 231 00', 'Sparta', 'Laconia', '27310 93163'),
(1067, 'General Hospital of Syros', 'Georgiou Papandreou 2, 841 00', 'Ermoupolis', 'Syros', '22813 60633'),
(1068, 'General Hospital of Trikala', 'Karditsis 56, 421 00', 'Trikala', 'Trikala', '24313 50152'),
(1069, 'General Hospital of Filiates', 'Mpempi Petrou 10, 463 00', 'Filiates', 'Thesprotia', '26643 60237'),
(1070, 'General Hospital of Florina', 'Egnatia 9, 531 00', 'Florina', 'Florina', '23853 50281'),
(1071, 'General Hospital of Chalkida', 'Gazepi Iraklis 48, 341 00', 'Chalcis', 'Euboea', '22210 21913'),
(1072, 'General Hospital of Halkidiki', 'Hippocrates 5, 631 00', 'Polygyros', 'Halkidiki', '23713 50257'),
(1073, 'General Hospital of Chania', 'Mournies of Chania, 733 00', 'Chania', 'Chania', '28210 22505'),
(1074, 'General Hospital of Chios', 'Elenas Venizelou 2, 821 00', 'Chios', 'Chiou', '22713 50136'),
(1075, 'General Oncology Hospital of Kifissia', 'Noufaron & Timiou Stavrou 14 Kalyftaki, 145 64', 'Athens', 'Attica', '210 3501725'),
(1076, 'Nursing Institute of the Army Pension Fund 417', 'Petraki Monastery 10-12, 115 21', 'Athens', 'Attica', '210 7246023'),
(1077, '251 Air Force General Hospital', 'Mesogeion & Panagioti Kanellopoulou Avenue 3, 115 27', 'Athens', 'Attica', '210 7464384'),
(1078, 'Athens Navy Hospital', 'Deinocrats 70, 115 21', 'Athens', 'Attica', '210 7261284'),
(1079, 'Agia Varvara Hospital of West Attica', 'Dodecanese 1, 123 51', 'Athens', 'Attica', '213 2076400'),
(1080, 'Sotiria Thoracic Diseases Hospital of Athens', 'Avenue Mesogeion 152, 115 27', 'Athens', 'Attica', '210 7784585'),
(1081, 'General Anti-Cancer Hospital Agios Savvas ', 'Avenue Alexandras 171, 115 22', 'Athens', 'Attica', '210 6409331'),
(1082, 'Panarkadiko Hospital of Tripoli', 'Red Cross End, 221 31', 'Tripoli', 'Arcadia', '27102 38175'),
(1083, 'University General Hospital of Athens - LAIKO', 'Agios Thomas 17, 115 27', 'Athens', 'Attica', '213 2061035'),
(1084, 'University General Hospital Attikon', 'Rimini 1, 124 62', 'Athens', 'Attica', '210 5831755'),
(1085, 'University Hospital of Athens Aretaio', 'Avenue 76 Vassilisis Sofias, 115 28', 'Athens', 'Attica', '210 7286301'),
(1086, 'Alexandroupolis University Hospital', '6th km Alexandroupolis-Makris Dragana, 681 00', 'Alexandroupoli', 'Evros', '25513 52001'),
(1087, 'University Hospital of Thessaloniki AXEPA', 'Stylianou Kyriakidis 1, 546 36', 'Thessaloniki', 'Thessaloniki', '23109 93461'),
(1088, 'University Hospital of Ioannina', 'Leof. Stavrou Niarchou, 455 00', 'Ioannina', 'Ioanninon', '26510 99456'),
(1089, 'University Hospital of Patras', 'Rio, 265 04', 'Patra', 'Achaea', '26136 03644'),
(1090, 'Athens Military Hospital 401', 'Avenue Mesogeion 138 & Katehaki, 115 25', 'Athens', 'Attica', '210 7494740');
-- ----------------------------------------------------------------------------------------------------------------

-- Dumping data for table `PATIENT`
INSERT INTO `PATIENT` (`Patient_NINo`, `Patient_First_Name`, `Patient_Surname`, `Patient_Father_Name`, `Patient_Hospitalised_In`) VALUES
('5423WQER32', 'Sophia', 'Brown', 'John', 'General Hospital of Didymoteicho'),
('235ERWT5RW', 'Emily', 'Ashley', 'David', 'University Hospital of Athens Aretaio'),
('AB4362D345', 'David', 'Cooper', '', 'General Hospital of Amaliada'),
('4WS2353415', 'Jessica', 'Harrison', '', 'Theagenio Cancer Hospital of Thessaloniki'),
('5423FEWTR4', 'Jonathan', 'Cole', 'Jason', ''),
('A534225643', 'Emily', 'Brown', 'Brandon', 'University Hospital of Ioannina'),
('QW35423WEI', 'Evan', 'Cooper', 'Evan', 'General Hospital of Amaliada'),
('2352QEWRTG', 'Taylor', 'Harrison', 'David', 'University Hospital of Patras'),
('EWFW345234', 'Jason', 'Harrison', '', 'General Hospital of Athens KAT');
-- ----------------------------------------------------------------------------------------------------------------

-- Dumping data for table `REQUEST`
INSERT INTO `REQUEST` (`Request_ID`, `Request_Creation_Date`, `Requested_Blood_Bags`, `Blood_Bags_Committed_To_Be_Donated`, `Request_Status`, `Request_Is_Urgent`, `Request_Created_By`, `Patient_NINo`) VALUES
(2061, '2022-05-05', 5, 0, 'Active', 'No', 'MatthewFox', '235ERWT5RW'),
(2059, '2022-05-04', 1, 1, 'Completed', 'No', 'AlyssaBell', 'EWFW345234'),
(2062, '2022-05-05', 6, 6, 'Completed', 'Yes', 'AndrewBrown', '5423WQER32'),
(2063, '2022-05-05', 4, 0, 'Deleted', 'Yes', 'AndrewBrown', '2352QEWRTG'),
(2065, '2022-05-05', 7, 7, 'Fulfilled', 'Yes', 'EmilyCole', '5423FEWTR4'),
(2064, '2022-05-05', 5, 5, 'Fulfilled', 'Yes', 'EmilyCole', '5423FEWTR4'),
(2058, '2022-05-03', 7, 7, 'Completed', 'No', 'AlyssaBell', '2352QEWRTG'),
(2057, '2022-05-03', 2, 2, 'Completed', 'No', 'AlyssaBell', 'QW35423WEI'),
(2056, '2022-05-03', 10, 0, 'Deleted', 'Yes', 'EvanBradley', '5423WQER32'),
(2055, '2022-05-02', 2, 2, 'Fulfilled', 'Yes', 'EvanBradley', '235ERWT5RW'),
(2054, '2022-05-02', 4, 4, 'Fulfilled', 'Yes', 'DavidCook', '235ERWT5RW'),
(2053, '2022-05-02', 3, 3, 'Fulfilled', 'No', 'DavidCook', '5423FEWTR4'),
(2052, '2022-05-02', 2, 2, 'Fulfilled', 'No', 'AndrewBrown', 'A534225643'),
(2051, '2022-05-02', 3, 3, 'Fulfilled', 'Yes', 'AndrewBrown', '4WS2353415'),
(2050, '2022-05-01', 2, 2, 'Completed', 'No', 'JasonCooper', 'AB4362D345'),
(2060, '2022-05-05', 3, 2, 'Active', 'Yes', 'MatthewFox', 'A534225643'),
(2066, '2022-05-05', 3, 0, 'Active', 'No', 'EvanBradley', 'A534225643'),
(2067, '2022-05-05', 1, 1, 'Completed', 'Yes', 'EvanBradley', '4WS2353415');
-- ----------------------------------------------------------------------------------------------------------------

-- Dumping data for table `USERS`
INSERT INTO `USERS` (`Username`, `User_Password`, `User_Email_Address`) VALUES
('JohnKennedy', '$2y$10$3IPiHA2OcZ1tKMcXA7.cLu.Jj/EUZLC4odDXNvZZHS7sE/HQs74vi', 'johnkennedy@yahoo.com'),     -- Password: 645Rdfw346
('EmilyCole', '$2y$10$iI5s25ZqhIj7gasCO5JUe.QmmMDmP3x3GhCbuqCY9zxHQzaiKojtG', 'emilycole@yahoo.com'),         -- Password: rtyEWFRur6
('EvanBradley', '$2y$10$DwFdlxkmUuJZ1nXOCHAsX.1G3sjXNGVsWe/SvUu/qwEMQigwKbnLy', 'evanbradley@outlook.com'),   -- Password: erge453dw
('AlyssaBell', '$2y$10$Z.2G/gHaXyT34zeU7DtdZe3BbAavQLIe7ySYXEo715aURvA5mbQOK', 'alyssabell@outlook.com'),     -- Password: EGHGRe54
('AnnaBella', '$2y$10$PEP/SS4fDG1U6HQ3naeZNO9i9t3GUdfGV9QGidgBqfyff085cXGem', 'annabella@outlook.com'),       -- Password: 547uy56trq5
('DavidCook', '$2y$10$Yt1H7teuR7RgNvtQbUDr0eX9Pjfmlh8mhfkjHWJuoBmk3J5.jrnTm', 'davidcook@gmail.com'),         -- Password: 4e45w2723
('AndrewBrown', '$2y$10$y/jBmnY8Ea1prqA6utzc4eKGGYAuONvrQ.zN6k5TafUXX9IqziLhu', 'andrewbrown@gmail.com'),     -- Password: 234ewa234
('JasonCooper', '$2y$10$YM8rB7pc8nGd1/pW/sOCieh0dBJyPPUoFLqLB9IZxu739DBS74tFe', 'jason-cooper@gmail.com'),    -- Password: 2468a12A34
('JonathanCook', '$2y$10$zZu9I0wE7Kdco50sR66IEe9oCX4KFlEJIHnxxRcEejhnD/lXJ5ipy', 'jonathancook@yahoo.com'),   -- Password: 645Rdfw346
('MatthewFox', '$2y$10$20wBYlfPamYVkAUh6buJz.pT0XmBfBkS80KqOKOEYsH9ZXtutv3iy', 'matthewfox@gmail.com');       -- Password: 436Rdetwe4
-- ----------------------------------------------------------------------------------------------------------------
