/*
DROP TABLE IF EXISTS agenzia_immobiliare;
DROP TABLE IF EXISTS pubblica;
DROP TABLE IF EXISTS inviaa;
DROP TABLE IF EXISTS inviac;
DROP TABLE IF EXISTS inviap;
DROP TABLE IF EXISTS legge;
DROP TABLE IF EXISTS annuncio;
DROP TABLE IF EXISTS proprieta;
DROP TABLE IF EXISTS cliente;
DROP TABLE IF EXISTS visita;
DROP TABLE IF EXISTS interagiscecon;
DROP TABLE IF EXISTS possiede;
DROP TABLE IF EXISTS proprietario;
DROP TABLE IF EXISTS messaggio;
DROP TABLE IF EXISTS garageProprieta;
DROP TABLE IF EXISTS cantina;
DROP TABLE IF EXISTS admin;
*/
CREATE DATABASE ageziamontanelli;

CREATE TABLE IF NOT EXISTS agenzia_immobiliare(
idAgenzia int  AUTO_INCREMENT,
nome  TEXT  DEFAULT "NOMEIMPRESA" ,
partitaIva  TEXT  ,
indirizzo  TEXT  ,
numeroTelefono  TEXT   UNIQUE,
email  TEXT   UNIQUE,
nomeProprietario  TEXT  ,
località  TEXT  ,
emailAg TEXT UNIQUE,
passAg TEXT UNIQUE,
pass TEXT UNIQUE,
PRIMARY KEY(idAgenzia)
);

CREATE TABLE IF NOT EXISTS proprieta(
codiceCatastale int  AUTO_INCREMENT,
indirizzo  TEXT  ,
comune  TEXT  ,
prezzo int ,
descrizione  TEXT  ,
tipo  TEXT  ,
dimensioni int ,
note  TEXT  ,
PRIMARY KEY(codiceCatastale)
);

CREATE TABLE IF NOT EXISTS annuncio(
idAnnuncio int  AUTO_INCREMENT,
descrizione  TEXT  ,
immagine  TEXT  ,
titolo  TEXT  ,
immagini  TEXT  ,
proprietà_id int UNIQUE,
PRIMARY KEY(idAnnuncio),
FOREIGN KEY(proprietà_id) REFERENCES proprieta(codiceCatastale)
);

CREATE TABLE IF NOT EXISTS proprietario(
codiceFiscale int  AUTO_INCREMENT,
nome  TEXT  ,
numeroTelefono  TEXT   UNIQUE,
email  TEXT   UNIQUE,
note  TEXT  ,
PRIMARY KEY(codiceFiscale)
);

CREATE TABLE IF NOT EXISTS cliente (
idCliente int  AUTO_INCREMENT,
nome  TEXT  ,
ragioneSociale  TEXT  ,
numeroTelefono  TEXT   UNIQUE,
email  TEXT UNIQUE ,
preferiti  TEXT  ,
emailC TEXT UNIQUE,
passC TEXT UNIQUE,
pass TEXT UNIQUE,
PRIMARY KEY(idCliente)
);

CREATE TABLE IF NOT EXISTS admin(
idAdmin int  AUTO_INCREMENT,
nome  TEXT  ,
località  TEXT  ,
tipo  TEXT  ,
id_agenzia int  UNIQUE,
emailA TEXT UNIQUE,
passA TEXT UNIQUE,
email TEXT UNIQUE,
pass TEXT UNIQUE,
PRIMARY KEY(idAdmin),
FOREIGN KEY(id_agenzia) REFERENCES agenzia_immobiliare(idAgenzia)
);

CREATE TABLE IF NOT EXISTS messaggio(
idMessaggio int  AUTO_INCREMENT,
dataM date ,
contenuto  TEXT  ,
oggetto  TEXT  ,
admin_id int  UNIQUE,
PRIMARY KEY(idMessaggio),
FOREIGN KEY(admin_id) REFERENCES admin(idAdmin)
);



CREATE TABLE IF NOT EXISTS garageProprieta(
idGarage int  AUTO_INCREMENT,
tipologia  TEXT  ,
piano int ,
numeroPosti int ,
tipoSaracinesca  TEXT  ,
proprieta_id int  UNIQUE,
metratura int ,
FOREIGN KEY(proprieta_id) REFERENCES proprieta(codiceCatastale),
PRIMARY KEY(idGarage)
);

CREATE TABLE IF NOT EXISTS cantina(
idcantina int  AUTO_INCREMENT,
metratura int ,
piano int ,
finestra boolean ,
proprieta_id int  UNIQUE,
FOREIGN KEY(proprieta_id) REFERENCES proprieta(codiceCatastale),
PRIMARY KEY(idcantina)
);   

CREATE TABLE IF NOT EXISTS pubblica(
id_Agenzia int  UNIQUE,
id_Annuncio int  UNIQUE,
FOREIGN KEY(id_Agenzia) REFERENCES agenzia_immobiliare(idAgenzia),
FOREIGN KEY(id_Annuncio) REFERENCES annuncio(idAnnuncio)
);

CREATE TABLE IF NOT EXISTS inviaa(
id_Agenzia int  UNIQUE,
id_messaggio int  UNIQUE,
dataM date ,
FOREIGN KEY(id_Agenzia) REFERENCES agenzia_immobiliare(idAgenzia),
FOREIGN KEY(id_messaggio) REFERENCES messaggio(idMessaggio)
);

CREATE TABLE IF NOT EXISTS legge(
id_Agenzia int  UNIQUE,
id_messaggio int  UNIQUE,
dataM date ,
FOREIGN KEY(id_Agenzia) REFERENCES agenzia_immobiliare(idAgenzia),
FOREIGN KEY(id_messaggio) REFERENCES messaggio(idMessaggio)
);

CREATE TABLE IF NOT EXISTS visita(
id_cliente int  UNIQUE,
idVisita int  UNIQUE,
dataM date ,
FOREIGN KEY(id_cliente) REFERENCES cliente(idCliente),
PRIMARY KEY (idVisita)
); 

CREATE TABLE IF NOT EXISTS interagiscecon(
id_cliente int  UNIQUE,
id_annuncio int  UNIQUE,
dataM date ,
FOREIGN KEY(id_cliente) REFERENCES cliente(idCliente),
FOREIGN KEY(id_annuncio) REFERENCES annuncio(idAnnuncio)
);

CREATE TABLE IF NOT EXISTS possiede(
proprietà_cc int  UNIQUE,
proprietario_cf int  UNIQUE,
percentualeProprieta int ,
FOREIGN KEY(proprietà_cc) REFERENCES proprieta(codiceCatastale),
FOREIGN KEY(proprietario_cf) REFERENCES proprietario(codiceFiscale)
);

CREATE TABLE IF NOT EXISTS inviac(
id_cliente int  UNIQUE,
id_messaggio int  UNIQUE,
dataM date ,
FOREIGN KEY(id_cliente) REFERENCES cliente(idCliente),
FOREIGN KEY(id_messaggio) REFERENCES messaggio(idMessaggio)
);

CREATE TABLE IF NOT EXISTS inviap(
id_proprietario int  UNIQUE,
id_messaggio int  UNIQUE,
dataM date ,
FOREIGN KEY(id_proprietario) REFERENCES proprietario(codiceFiscale),
FOREIGN KEY(id_messaggio) REFERENCES messaggio(idMessaggio)
);

