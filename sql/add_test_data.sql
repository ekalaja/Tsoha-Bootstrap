-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja (tunnus, salasana, email, nimi) VALUES ('make', 'sala', 'mti@mail.com', 'matti');
INSERT INTO Kayttaja (tunnus, salasana, email, nimi) VALUES ('pete', 'sala2', 'pete@mail.com', 'pekka');
INSERT INTO Ideaali (nimi, luokka, vari) VALUES ('kortti1', 'olento', 'punainen');
INSERT INTO Ideaali (nimi, luokka, vari) VALUES ('kortti2', 'ihminen', 'punainen');
INSERT INTO Tavara (ideaali_id, kayttaja_id, kunto, lukittu) VALUES (1, 2, 'hyvä', FALSE);