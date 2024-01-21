# AGGIORNAMENTI
21-01-24: aggiunto codice esempio per la mappa che ho trovato, ora vanno create le pagine vere e proprie simili al mockup presentato qui sotto
# REQUISITI PER PROVARE
Aver installato xampp ed aver scaricato tutti i file della cartella finale, compreso il file sql numero 1 creazione database, poi aprire il file "debugPage.php"
# AGENZIA IMMOBILIARE
Gestione degli immobili in vendita con le relative informazioni e fotografie, con possiblità di prenotare una visita, gestire i dati dei clienti.
## COME FUNZIONA?
Gestione degli immobili in vendita con le relative informazioni e fotografie, con possiblità di prenotare una visita, gestire i dati dei clienti. La webapp si basa sulla creazione di annunci, che possono riguardare molte tipologie di proprietà, dalle residenziali, a quelle commerciali come uffici, edifici produttivi, autorimesse, depositi, uffici ed infine terreni.
## COSA VA A RISOLVERE?
Risolve il problema di mostrare gli immobili in vendita, stile vetrina, ad un grande numero di persone. Un sotto problema risolto è quello di avere un archivio con tutti  gli immobili in vendita, con le relative informazioni associate e proprietari.
## PER CHI è STUDIATA?
Il target del software sono principalmente Aziende, sia agenzie immobiliari che imprese di costruzione che vogliono vendere le proprie realizzazioni oltre a privati. Mentre gli utilizzatori saranno clienti privati o ancora una volta imprese di costruzione, in particolare per quanto rigurda la vendità di terreni ed immobili commerciali
## TECNOLOGIE UTILIZZATE
 * DA DEFINIRE
    * - [ ] javascript
    * - [ ] html
    * - [ ] CSS
    * - [ ] php
    * - [ ] mysql
      - [ ] servizio di webhosting (probabilmente altervista)
## FUNZIONALITA'
* PER AGENZIA
    * - [x] pubblicazione annunci
    * - [x] archiviazione dati edifici
    * - [x] archiviazione dati proprietari e clienti
    * - [ ] suddivisione delle proprietà in tipologie
    * - [ ] contattare i proprietari
    * - [ ] contattare i clienti
    * - [ ] modificare informazioni su proprieta ed annunci
    * - [ ] prenotare una visita
* PER CLIENTI
    * - [ ] visualizzazione annunci
    * - [ ] prenotazione visite
* PER PROPRIETARI 
    * - [ ] contattare l'agenzia
      - [ ] visualizzare annunci
## BACKEND
* DESCRIZIONE:
    * - agenzia, può aggiungere, togliere e modificare annunci, rimuovere clienti e proprietari, registrarli e messaggiare liberamente con tutti i clienti
    * - cliente, può visualizzare annunci, metterli nei preferiti, prenotare visite e messaggiare con le agenzie 
    * - admin sistema, può aggingere o rimuovere agenzie, aggiungere, modificare e rimuovere gli annunci, per esempio in caso di truffa 
* HOME PER AGENZIA
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/63ea623c-bc17-4554-9485-dbc6634f584b)
* HOME PER CLIENTE
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/26ac7050-e59a-4baf-8396-434c84892941)
* HOME PER ADMIN
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/92ec33bc-19f8-4bdb-8027-8a645518e71b)
* LISTA AGENZIE ADMIN
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/2442136b-bba8-4ce2-af83-794232797268)
* AGGIUNGI AGENZIA ADMIN
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/14db3ea6-e7dc-49c1-b9f2-7d18043ff619)
* LISTA PRENOTAZIONI CLIENTE
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/139607da-fa9d-4204-98cd-b0d4d058b44e)
* VENDI PROPRIETA' CLIENTE
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/432182f5-aa6d-4102-becf-8df97d25c66b)
* I MIEI MESSAGGI CLIENTE
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/fd27a1da-5a5d-4aab-8a84-273b1595a0fb)
* I MIEI PREFERITI CLIENTE
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/2abd9b52-1ecb-4258-985f-fab55e16dac3)
* LISTA CLIENTI AGENZIA
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/0dcf162c-bbda-47d0-80ab-6f691d984490)
* LISTA PROPRIETARI AGENZIA
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/307658b3-9d00-4a6f-8234-27158cb18e46)
* AGGIUNGI/MODIFICA ANNUNCIO AGENZIA/ADMIN
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/bf4165cf-ff26-4f75-8e6b-387723c93f79)
* LISTA PROPRIETA' AGENZIA
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/94450344-1ec0-4dc6-b836-bf1c23fce4b6)
## SCHEMA ER 
![oneA](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/a8207ecf-3e92-4898-8b36-21dc9f23330b)
![two](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/97b3d41a-a381-44e7-94e7-e71ef09d3d57)
## SCHEMA ER E SCHEMA LOGICO RELAZIONALE VISTA D'INSIEME
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/e428ee1f-e133-4b12-9f05-1ed8d729031b)
## SCHEMA LOGICO RELAZIONALE
![terzoA](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/d2a8a633-ce1b-47cb-91e2-b07a39490720)
## SCHEMA RELAZIONALE
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/f1e776b9-8cde-4385-9a60-9e61d1e12a8e)
## DDL --> CREAZIONE TABELLE
Per scaricare il file di creazione delle tabelle del database, apri il file con estensione .sql sulla repository (utilizza xampp per creare un server locale)
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/8536bf4e-59a2-49ee-b521-d1abcbebfeb3)
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/c3777b57-f9cd-4db7-bdd8-efc0d2885081)
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/1ccab12c-7df8-480c-9146-0b0e92885b5e)
![image](https://github.com/MarcoMontanelli/agenziaImmobiliare/assets/101709469/b911eeb1-0994-499f-8c5c-98d29b7a9eae)
# TODO
    * - [] MIGLIORARE LE PAGINE E L'INSERIMENTO DEI DATI
    * - [] MODIFICARE ER, SCHEMA LOGICO E SHCEMA LOGICO RELAZIONALE (DEVO AVERE PIù DI UN IMMAGINE PER ANNUNCIO)
    * - [] AGGIUNGERE LA HOMEPAGE 
    * - [] AGGIUNGERE UN PICCOLO SISTEMA DI RICERCA CON DEI CAMPI PER LE VARIE CARATTERISTICHE CHE SERVONO 
    * - [] CREARE LE VARIE PAGINE DEL PROGETTO ED IMPLEMENTARCI LE VARIE FUNZONI CHE HO CREATO A PARTE COLLEGADOLE CON I VARI PULSANTI
    * - [] MIGLIORARE, LO STILE E RENDERLO SIMILE AL MOCKUP
    * - [] MIGLIORARE GLI INSERIMENTI DEI DATI PER RENDERE SICURI D HTML E SQL INJECTIONS
    * - [] MIGLIORARE LE SICUREZZA DELLE PAGINE E DEL'INSERIMENTO DATI
    * - [] RIDEFINIRE LA PAGINA DI LOGIN ED INSERIRE IL RECUPERO PASSWORD, IL VERIFICA CCOUNT E GESTIRE INVIO DI EMAIL 
    * - [] IL RESTO DELLE FUNZIONALITA'
















