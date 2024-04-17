<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

// Crea connessione
$connessione = new mysqli($servername, $username, $password, $dbname);

// Controlla connessione
if ($connessione->connect_error) {
    die("Connessione fallita: " . $connessione->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_REQUEST['tabella'])) {
        switch ($_REQUEST['tabella']) {
            case 'admin':
                $stmt = $connessione->prepare("INSERT INTO admin (nome, località, tipo, id_agenzia, email, pass, verificato) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssissi", $_POST['nome'], $_POST['località'], $_POST['tipo'], $_POST['id_agenzia'], $_POST['email'], $hashed_pass, $_POST['verificato']);

                // Hash della password per la sicurezza
                $hashed_pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

                if ($stmt->execute()) {
                    echo "Nuovo admin creato con successo";
                } else {
                    echo "Errore: " . $stmt->error;
                }

                $stmt->close();
                // Termina lo script dopo l'inserimento

                break;
            case 'agenzia_immobiliare':
                // Logica di inserimento per agenzia_immobiliare
                $stmt = $connessione->prepare("INSERT INTO agenzia_immobiliare (nome, partitaIva, indirizzo, numeroTelefono, email, nomeProprietario, località, pass, verificato, fotoProfilo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssssis", $_POST['nome'], $_POST['partitaIva'], $_POST['indirizzo'], $_POST['numeroTelefono'], $_POST['email'], $_POST['nomeProprietario'], $_POST['località'], $hashed_pass, $_POST['verificato'], $_POST['fotoProfilo']);

                // Assumi di aver già fatto hashing della password
                $hashed_pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

                if ($stmt->execute()) {
                    echo "Nuova agenzia inserita con successo";
                } else {
                    echo "Errore: " . $stmt->error;
                }
                $stmt->close();
                break;

            case 'annuncioir':
                // Preparazione della query SQL per inserire un nuovo annuncio
                $stmt = $connessione->prepare("INSERT INTO annuncioir (titolo, tagsRicerca, descrizione, dataCreazione) VALUES (?, ?, ?, NOW())");
                $stmt->bind_param("sss", $_POST['titolo'], $_POST['tagsRicerca'], $_POST['descrizione']);

                if ($stmt->execute()) {
                    echo "Nuovo annuncio inserito con successo";
                } else {
                    echo "Errore durante l'inserimento: " . $stmt->error;
                }
                $stmt->close();
                break;
            case 'cliente':
                $stmt = $connessione->prepare("INSERT INTO cliente (nome, ragioneSociale, numeroTelefono, email, preferiti, pass) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $_POST['nome'], $_POST['ragioneSociale'], $_POST['numeroTelefono'], $_POST['email'], $_POST['preferiti'], $hashed_pass);

                // Hashing della password per maggiore sicurezza
                $hashed_pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

                if ($stmt->execute()) {
                    echo "Nuovo cliente inserito con successo";
                } else {
                    echo "Errore durante l'inserimento: " . $stmt->error;
                }
                $stmt->close();
                break;
            case 'immobili_residenziali':
                // Preparazione della query SQL per inserire un nuovo immobile
                $query = "INSERT INTO immobili_residenziali (tipologia, comune, indirizzo, numeroLocali, numeroBagni, prezzo, dimensioni, numeroPostiAuto, annoCostruzione, pianiTotali, classeEnergetica, giardino, ascensore, balcone, allarme, inferriate, portoncinoBlindato, ariaCondizionata, internet, latitudine, longitudine) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $connessione->prepare($query);

                // Bind dei parametri
                $stmt->bind_param(
                    "sssiidiiisiiiiiiiiidd",
                    $_POST['tipologia'],
                    $_POST['comune'],
                    $_POST['indirizzo'],
                    $_POST['numeroLocali'],
                    $_POST['numeroBagni'],
                    $_POST['prezzo'],
                    $_POST['dimensioni'],
                    $_POST['numeroPostiAuto'],
                    $_POST['annoCostruzione'],
                    $_POST['pianiTotali'],
                    $_POST['classeEnergetica'],
                    $giardino,
                    $ascensore,
                    $balcone,
                    $allarme,
                    $inferriate,
                    $portoncinoBlindato,
                    $ariaCondizionata,
                    $internet,
                    $_POST['latitudine'],
                    $_POST['longitudine']
                );

                // Esecuzione della query
                if ($stmt->execute()) {
                    echo "Nuovo immobile inserito con successo";
                } else {
                    echo "Errore durante l'inserimento: " . $stmt->error;
                }

                $stmt->close();
                break;

        }
    }
    exit; // Ferma lo script dopo aver gestito la POST
}
if (isset($_GET['delete']) && isset($_GET['tabella'])) {
    $id = $_GET['delete'];
    $tabella = $_GET['tabella'];

    // Avvia una transazione per mantenere l'integrità dei dati
    $connessione->begin_transaction();

    try {
        // Se stai eliminando un immobile, elimina prima tutti gli annunci correlati
        if ($tabella == 'immobiliresidenziali') {
            // Prima, elimina tutte le immagini degli annunci correlati all'immobile
            $queryEliminaImmagini = "DELETE immaginiannuncio FROM immaginiannuncio JOIN annuncioir ON immaginiannuncio.AnnuncioIr_id = annuncioir.idAnnuncioIr WHERE annuncioir.ImmobileR_id = ?";
            $stmtEliminaImmagini = $connessione->prepare($queryEliminaImmagini);
            $stmtEliminaImmagini->bind_param('s', $id);
            $stmtEliminaImmagini->execute();
            $stmtEliminaImmagini->close();

            // Poi, elimina tutti gli annunci correlati all'immobile
            $queryEliminaAnnunci = "DELETE FROM annuncioir WHERE ImmobileR_id = ?";
            $stmtEliminaAnnunci = $connessione->prepare($queryEliminaAnnunci);
            $stmtEliminaAnnunci->bind_param('s', $id);
            $stmtEliminaAnnunci->execute();
            $stmtEliminaAnnunci->close();
        }

        // Ora procedi con l'eliminazione del record principale (es. immobile)
        $idNameMap = [
            'admin' => 'idAdmin',
            'agenzia_immobiliare' => 'idAgenzia',
            'annuncioir' => 'idAnnuncioIr',
            'cliente' => 'idCliente',
            'immobiliresidenziali' => 'codiceCatastale',
        ];

        if (!isset($idNameMap[$tabella])) {
            throw new Exception("Tabella non valida");
        }
        $idName = $idNameMap[$tabella];

        $query = "DELETE FROM $tabella WHERE $idName = ?";
        $stmt = $connessione->prepare($query);
        $stmt->bind_param('s', $id);

        if (!$stmt->execute()) {
            throw new Exception("Errore durante l'eliminazione: " . $stmt->error);
        }

        $connessione->commit();
        echo "Record eliminato con successo";

        $stmt->close();
    } catch (Exception $e) {
        $connessione->rollback();
        echo $e->getMessage();
    }

    exit;
}


if (isset($_REQUEST['tabella'])) {
    $tabella = $_REQUEST['tabella'];

    // Se l'ID è presente nell'URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Costruisci la query per selezionare l'entry specifica
        $query = "SELECT * FROM $tabella WHERE ";

        // Seleziona il nome della chiave primaria in base alla tabella
        switch ($tabella) {
            case 'admin':
                $idName = 'idAdmin';
                break;
            case 'agenzia_immobiliare':
                $idName = 'idAgenzia';
                break;
            case 'annuncioir':
                $idName = 'idAnnuncioIr';
                break;
            case 'cliente':
                $idName = 'idCliente';
                break;
            case 'immobiliresidenziali':
                $idName = 'codiceCatastale';
                break;
            default:
                die("Tabella non valida");
        }

        // Aggiungi il nome della chiave primaria alla query
        $query .= "$idName = ?";
        $stmt = $connessione->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $risultato = $stmt->get_result();
        if ($risultato) {
            header('Content-Type: application/json');
            echo json_encode($risultato->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
        } else {
            echo "Errore nella query: " . $connessione->error;
        }
    } else {
        // Se l'ID non è presente, restituisci tutti i risultati come prima
        $query = "SELECT * FROM $tabella";
        $stmt = $connessione->prepare($query);
        $stmt->execute();
        $risultato = $stmt->get_result();
        if ($risultato) {
            header('Content-Type: application/json');
            echo json_encode($risultato->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
        } else {
            echo "Errore nella query: " . $connessione->error;
        }
    }
} else {
    // Se il parametro 'tabella' non è presente, restituisci l'elenco delle tabelle
    echo ("
<!DOCTYPE html>
<html>
    <head>
        <title>Api</title>
    </head>
    <body>
        <div>
            <h1>Apis</h1>
        </div>
        <hr>
        <div style='padding-left: 20px; padding-top:10px;'>
            <h2>READ</h2>
            
            <h2><a href='api/admin'>admin</a></h2>
            <h2><a href='api/agenzia_immobiliare'>agenzie</a></h2>
            <h2><a href='api/annuncioir'>annunci</a></h2>
            <h2><a href='api/cliente'>clienti</a></h2>
            <h2><a href='api/immobiliresidenziali'>immobili Residenziali</a></h2>
            <h2><a href='api/admin/3'>admin 3 prova</a></h2>
            <h2><a href='api/agenzia_immobiliare/14'>agenzia 14 prova</a></h2>
            <h2><a href='api/annuncioir/22'>annuncio 22 prova</a></h2>
            <h2><a href='api/cliente/17'>cliente 17 prova</a></h2>
            <h2><a href='api/immobiliresidenziali/123456789'>immobili Residenziale codice catastale 123456789 prova</a></h2>

            <h2>DELETE</h2> 
            <h2><a href='api/admin/delete/15'>admin 15 prova</a></h2>
            <h2><a href='api/agenzia_immobiliare/delete/20'>agenzia 20 prova</a></h2>
            <h2><a href='api/annuncioir/delete/25'>annuncio 25 prova</a></h2>
            <h2><a href='api/cliente/delete/16'>cliente 16 prova</a></h2>
            <h2><a href='api/immobiliresidenziali/delete/3456789876'>immobili Residenziale codice catastale 3456789876 prova</a></h2>
        </div>
        <h2>CREATE</h2>
        <h2>Inserisci un nuovo Admin</h2>
        <form action='api.php?tabella=admin' method='post'>
            <div>
                <label for='nome'>Nome:</label>
                <input type='text' id='nome' name='nome' required>
            </div>
            <div>
                <label for='localita'>Località:</label>
                <input type='text' id='localita' name='localita' required>
            </div>
            <div>
                <label for='tipo'>Tipo:</label>
                <input type='text' id='tipo' name='tipo' required>
            </div>
            
            <div>
                <label for='email'>Email:</label>
                <input type='email' id='email' name='email' required>
            </div>
            <div>
                <label for='pass'>Password:</label>
                <input type='password' id='pass' name='pass' required>
            </div>
            
            <button type='submit'>Invia</button>
        </form>

        <h2>Inserisci una nuova Agenzia Immobiliare</h2>
        <form action='api.php?tabella=agenzia_immobiliare' method='post'>
            <div>
                <label for='nome'>Nome:</label>
                <input type='text' id='nome' name='nome' required>
            </div>
            <div>
                <label for='partitaIva'>Partita IVA:</label>
                <input type='text' id='partitaIva' name='partitaIva' required>
            </div>
            <div>
                <label for='indirizzo'>Indirizzo:</label>
                <input type='text' id='indirizzo' name='indirizzo' required>
            </div>
            <div>
                <label for='numeroTelefono'>Numero Telefono:</label>
                <input type='text' id='numeroTelefono' name='numeroTelefono' required>
            </div>
            <div>
                <label for='email'>Email:</label>
                <input type='email' id='email' name='email' required>
            </div>
            <div>
                <label for='nomeProprietario'>Nome Proprietario:</label>
                <input type='text' id='nomeProprietario' name='nomeProprietario' required>
            </div>
            <div>
                <label for='località'>Località:</label>
                <input type='text' id='località' name='località' required>
            </div>
            <div>
                <label for='pass'>Password:</label>
                <input type='password' id='pass' name='pass' required>
            </div>
            <button type='submit'>Invia</button>
        </form>
        <h2>Inserisci un nuovo Annuncio Immobiliare</h2>
        <form action='api.php?tabella=annuncioir' method='post'>
            <div>
                <label for='titolo'>Titolo:</label>
                <input type='text' id='titolo' name='titolo' required>
            </div>
            <div>
                <label for='tagsRicerca'>Tags Ricerca:</label>
                <input type='text' id='tagsRicerca' name='tagsRicerca' required>
            </div>
            <div>
                <label for='descrizione'>Descrizione:</label>
                <textarea id='descrizione' name='descrizione' required></textarea>
            </div>
            <button type='submit'>Invia</button>
        </form>
        <h2>Inserisci un nuovo Cliente</h2>
        <form action='api.php?tabella=cliente' method='post'>
            <div>
                <label for='nome'>Nome:</label>
                <input type='text' id='nome' name='nome' required>
            </div>
            <div>
                <label for='ragioneSociale'>Ragione Sociale:</label>
                <input type='text' id='ragioneSociale' name='ragioneSociale'>
            </div>
            <div>
                <label for='numeroTelefono'>Numero Telefono:</label>
                <input type='text' id='numeroTelefono' name='numeroTelefono' required>
            </div>
            <div>
                <label for='email'>Email:</label>
                <input type='email' id='email' name='email' required>
            </div>
            <div>
                <label for='preferiti'>Preferiti:</label>
                <input type='text' id='preferiti' name='preferiti'>
            </div>
            <div>
                <label for='pass'>Password:</label>
                <input type='password' id='pass' name='pass' required>
            </div>
            <button type='submit'>Invia</button>
        </form>
        <h2>Inserisci un nuovo Immobile</h2>
        <form action='api.php?tabella=immobiliresidenziali' method='post'>
            <div>
                <label for='tipologia'>Tipologia:</label>
                <input type='text' id='tipologia' name='tipologia' required>
            </div>
            <div>
                <label for='comune'>Comune:</label>
                <input type='text' id='comune' name='comune' required>
            </div>
            <div>
                <label for='indirizzo'>Indirizzo:</label>
                <input type='text' id='indirizzo' name='indirizzo' required>
            </div>
            <div>
                <label for='numeroLocali'>Numero Locali:</label>
                <input type='number' id='numeroLocali' name='numeroLocali' required>
            </div>
            <div>
                <label for='numeroBagni'>Numero Bagni:</label>
                <input type='number' id='numeroBagni' name='numeroBagni' required>
            </div>
            <div>
                <label for='prezzo'>Prezzo:</label>
                <input type='number' id='prezzo' name='prezzo' required>
            </div>
            <div>
                <label for='dimensioni'>Dimensioni (mq):</label>
                <input type='number' id='dimensioni' name='dimensioni' required>
            </div>
            <div>
                <label for='numeroPostiAuto'>Numero Posti Auto:</label>
                <input type='number' id='numeroPostiAuto' name='numeroPostiAuto'>
            </div>
            <div>
                <label for='annoCostruzione'>Anno Costruzione:</label>
                <input type='number' id='annoCostruzione' name='annoCostruzione' required>
            </div>
            <div>
                <label for='pianiTotali'>Piani Totali:</label>
                <input type='number' id='pianiTotali' name='pianiTotali'>
            </div>
            <div>
                <label for='classeEnergetica'>Classe Energetica:</label>
                <input type='text' id='classeEnergetica' name='classeEnergetica' required>
            </div>
            <div>
                <label for='latitudine'>Latitudine:</label>
                <input type='text' id='latitudine' name='latitudine' required>
            </div>
            <div>
                <label for='longitudine'>Longitudine:</label>
                <input type='text' id='longitudine' name='longitudine' required>
            </div>
            <!-- Aggiungi qui gli input per i campi booleani come Giardino, Ascensore ecc. -->
            <div>
                <label for='giardino'>Giardino:</label>
                <input type='checkbox' id='giardino' name='giardino' value='1'>
            </div>
            <div>
                <label for='ascensore'>Ascensore:</label>
                <input type='checkbox' id='ascensore' name='ascensore' value='1'>
            </div>
            <div>
                <label for='balcone'>Balcone:</label>
                <input type='checkbox' id='balcone' name='balcone' value='1'>
            </div>
            <div>
                <label for='allarme'>Allarme:</label>
                <input type='checkbox' id='allarme' name='allarme' value='1'>
            </div>
            <div>
                <label for='inferriate'>Inferriate:</label>
                <input type='checkbox' id='inferriate' name='inferriate' value='1'>
            </div>
            <div>
                <label for='portoncinoBlindato'>Portoncino Blindato:</label>
                <input type='checkbox' id='portoncinoBlindato' name='portoncinoBlindato' value='1'>
            </div>
            <div>
                <label for='ariaCondizionata'>Aria Condizionata:</label>
                <input type='checkbox' id='ariaCondizionata' name='ariaCondizionata' value='1'>
            </div>
            <div>
                <label for='internet'>Internet:</label>
                <input type='checkbox' id='internet' name='internet' value='1'>
            </div>

            <!-- Ripeti per ascensore, balcone, allarme, ecc. -->
            <button type='submit'>Invia</button>
        </form>
    </body>
</html>");
}
?>