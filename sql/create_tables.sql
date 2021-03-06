-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja(
id SERIAL PRIMARY KEY,
tunnus varchar(10) UNIQUE,
nimi varchar(50) NOT NULL,
email varchar(50) NOT NULL,
salasana varchar(50) NOT NULL
);

CREATE TABLE Ideaali(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL UNIQUE,
luokka varchar(50) NOT NULL,
vari varchar(50)
);

CREATE TABLE Tavara(
id SERIAL PRIMARY KEY,
ideaali_id INTEGER REFERENCES Ideaali(id) NOT NULL,
kayttaja_id INTEGER REFERENCES Kayttaja(id) NOT NULL,
vaihtokohde_id INTEGER REFERENCES Ideaali(id),
kunto varchar(50),
lukittu boolean DEFAULT FALSE,
lukitus_aika TIME
);

CREATE TABLE Tarjous(
id SERIAL PRIMARY KEY,
kohde_id INTEGER NOT NULL REFERENCES Tavara(id) ON DELETE CASCADE,
tarjottava_id INTEGER NOT NULL REFERENCES Tavara(id) ON DELETE CASCADE
);
