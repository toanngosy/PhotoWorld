
--Users
INSERT INTO utilisateur VALUES ('Batman', 'Alexandre', 'Benjamin', 'batman@gmail.com', '1995-08-14', 'M', 'American', 'Save the world', 'Prive');
INSERT INTO utilisateur VALUES ('Superman', 'Nguyen', 'Jonathan', 'superman@gmail.com', '1995-01-11', 'M', 'French', 'I have superpower', 'Public');
INSERT INTO utilisateur VALUES ('Joker', 'Guam', 'Alex', 'joker@gmail.com', '1995-08-12', 'M', 'Chinese', 'jajaja', 'Prive');
--Joker envoie 'Friend request' a Batman, Batman n'accept pas encore
INSERT INTO Attend_Ami VALUES ('Joker', 'Batman');
--Batman est l'ami de Superman
INSERT INTO Ami VALUES ('Batman', 'Superman');
INSERT INTO Ami VALUES ('Superman', 'Joker');
--Users postent les photos
INSERT INTO Likable_objet VALUES (DEFAULT, 'Joker');
INSERT INTO Photo                            
SELECT currval('Likable_objet_id_seq'), 'Smile of Joker', 'Smile <3', 'https://s-media-cache-ak0.pinimg.com/564x/65/09/2c/65092c954369405bbcf9c867b08a194a.jpg', 'jpg';

INSERT INTO Likable_objet VALUES (DEFAULT, 'Batman');
INSERT INTO Photo                            
SELECT currval('Likable_objet_id_seq'), 'Wing', 'Me and the moon', 'http://www.batmangamesonly.com/images/wallpapers/batman-4-1024x768.jpg', 'jpg';
--Users postent les commentaires sur photos
INSERT INTO Likable_objet VALUES (DEFAULT, 'Joker');
INSERT INTO Commentaire                            
SELECT currval('Likable_objet_id_seq'), 'I will break you tonight', 2; --Joker commente sur Batman photo

INSERT INTO Likable_objet VALUES (DEFAULT, 'Batman');
INSERT INTO Commentaire                            
SELECT currval('Likable_objet_id_seq'), 'ahaha', 2; --Batman reply Joker
--Users like images et commentaires
INSERT INTO Likes VALUES (2, 'Superman', 1); --Superman like image de Batman
INSERT INTO Likes VALUES (3, 'Superman', -1); --Superman dislike commentaire de Joker 
INSERT INTO Likes VALUES (4, 'Superman', 1); --Superman like image de Batman
--Users commentaire et tag
INSERT INTO Likable_objet VALUES (DEFAULT, 'Superman');
INSERT INTO Commentaire                            
SELECT currval('Likable_objet_id_seq'), 'I will protect you #Justice #Fight', 2; --Superman commente & tagsur Batman photo
INSERT INTO Tag VALUES (currval('Likable_objet_id_seq'),'#Justice');

INSERT INTO Tag VALUES (currval('Likable_objet_id_seq'),'#Fight');
--album
INSERT INTO Album VALUES (DEFAULT, 'Gotham city', 'Batman');
----ajouter image dans album
INSERT INTO Likable_objet VALUES (DEFAULT, 'Batman');
INSERT INTO Photo                            
SELECT currval('Likable_objet_id_seq'), 'Night', 'Gotham at Night', 'http://www.anime-kun.net/animes/screenshots/batman-gotham-knight-1728.jpg', 'jpg', 1;
--modifier vignette de l'album -> au moment des que dans l'album il existe d'un image
UPDATE Album SET vignette = currval('Likable_objet_id_seq') WHERE id_album = 1; 
