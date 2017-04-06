DROP TABLE IF EXISTS tag  CASCADE ;
DROP TABLE IF EXISTS commentaire  CASCADE;
DROP TABLE IF EXISTS attend_ami  CASCADE;
DROP TABLE IF EXISTS ami  CASCADE;
DROP TABLE IF EXISTS Likes  CASCADE;

DROP TABLE IF EXISTS album  CASCADE;
DROP TABLE IF EXISTS photo  CASCADE;
DROP TABLE IF EXISTS likable_objet  CASCADE;
DROP TABLE IF EXISTS utilisateur  CASCADE;

CREATE TABLE Utilisateur (
	pseudonyme 	VARCHAR(30) PRIMARY KEY,
	nom 		VARCHAR(30) NOT NULL,
	prenom 		VARCHAR(30) NOT NULL,
	email 		VARCHAR(30) NOT NULL,
	dateNais 	DATE 	NOT NULL,
	sex 		CHAR(1) NOT NULL ,
	pays 		VARCHAR(50) ,
	titre 		VARCHAR(30)NOT NULL,
	statut_profil 	VARCHAR(6) NOT NULL ,
	CHECK (sex IN ('M', 'F')),
	CHECK (statut_profil IN ('Public','Prive' ))
);

CREATE TABLE Likable_objet(
	id  	SERIAL,
	auteur 	VARCHAR(30) REFERENCES utilisateur(pseudonyme),

	PRIMARY KEY (id)
);


CREATE TABLE Photo (
	id_photo int REFERENCES Likable_objet(id) ,
	titre 		VARCHAR(50) NOT NULL,
	legende		VARCHAR(50),
	URL 		TEXT NOT NULL,
	format 		VARCHAR(4) NOT NULL,
	album 		INTEGER,
	PRIMARY KEY (id_photo)

);
CREATE TABLE Album (
	id_album 	SERIAL,
	titre 		VARCHAR(50) NOT NULL,
	proprietaire 	VARCHAR(50) REFERENCES utilisateur (pseudonyme),
	legende 	TEXT,
	vignette int REFERENCES photo (id_photo),
	PRIMARY KEY(id_album),
	UNIQUE(titre, proprietaire)
);

ALTER TABLE photo
ADD FOREIGN KEY (album) REFERENCES album (id_album);

CREATE TABLE Likes (
	objet	 		INTEGER,
	liker 			VARCHAR(20),
	choix			INTEGER,

	PRIMARY KEY(objet, liker),
	CHECK (choix IN (-1, 1))
);

CREATE TABLE Ami(
	User1 VARCHAR(50) REFERENCES utilisateur (pseudonyme),
	User2 VARCHAR(50) REFERENCES utilisateur (pseudonyme),
	PRIMARY KEY(User1,User2)


);

CREATE TABLE Attend_Ami (
	User1 VARCHAR(20) REFERENCES utilisateur (pseudonyme),
	User2 VARCHAR(20) REFERENCES utilisateur (pseudonyme),

	PRIMARY KEY(User1, User2)
);

CREATE TABLE Commentaire(
	id_commentaire 	INT REFERENCES Likable_objet (id) ,
	texte 		TEXT NOT NULL,
	photo 		INT REFERENCES photo (id_photo),
	PRIMARY KEY (id_commentaire)
);



CREATE TABLE Tag (
	commentaire int REFERENCES commentaire (id_commentaire) ,
	tag VARCHAR(20),
	PRIMARY KEY (commentaire,tag),
	CHECK (tag ~ '^[:blank:]*$')
);



---------------------------------
--Triggers--


CREATE OR REPLACE FUNCTION checktag() RETURNS TRIGGER AS $$
DECLARE
	nb_tag integer;
BEGIN
	 SELECT COUNT(*) INTO nb_tag FROM tag WHERE commentaire = NEW.commentaire;
	IF (nb_tag < 5) THEN
		RETURN NEW;
	ELSE RETURN OLD;
	END IF;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER check_tag_trigger
BEFORE INSERT ON tag
FOR EACH ROW EXECUTE PROCEDURE checktag();

CREATE OR REPLACE FUNCTION checkfriend() RETURNS TRIGGER AS $$
DECLARE
	nb integer;
BEGIN
	 SELECT COUNT(*) INTO nb FROM ami WHERE user1=NEW.user2 AND user2=NEW.user1;
	IF (nb = 0 ) THEN
		RETURN NEW;
	ELSE RETURN OLD;
	END IF;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER check_friend_trigger
BEFORE INSERT ON ami
FOR EACH ROW EXECUTE PROCEDURE checkfriend();
