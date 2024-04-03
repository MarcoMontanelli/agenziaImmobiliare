<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connessione al database
    print_r($_FILES);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ageziamontanelli";

    // Crea connessione
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Controlla connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Preparazione della query per inserire i dati in ImmobiliResidenziali
    $sqlImmobili = "INSERT INTO ImmobiliResidenziali (codiceCatastale, tipologia, comune, indirizzo, numeroLocali, numeroBagni, prezzo, dimensioni, numeroPostiAuto, annoCostruzione, pianiTotali, classeEnergetica, giardino, ascensore, balcone, allarme, inferriate, portoncinoBlindato, ariaCondizionata, internet, latitudine, longitudine) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmtImmobili = $conn->prepare($sqlImmobili);

    // Gestione dei valori booleani dei checkboxes
    $giardino = isset($_POST['giardino']) ? 1 : 0;
    $ascensore = isset($_POST['ascensore']) ? 1 : 0;
    $balcone = isset($_POST['balcone']) ? 1 : 0;
    $allarme = isset($_POST['allarme']) ? 1 : 0;
    $inferriate = isset($_POST['inferriate']) ? 1 : 0;
    $portoncinoBlindato = isset($_POST['portoncinoBlindato']) ? 1 : 0;
    $ariaCondizionata = isset($_POST['ariaCondizionata']) ? 1 : 0;
    $internet = isset($_POST['internet']) ? 1 : 0;

    $latitudine = $_POST['latitudine'] ?? null;
    $longitudine = $_POST['longitudine'] ?? null;

    $stmtImmobili->bind_param("ssssiiiiiiisiiiiiiiidd", $_POST['codiceCatastale'], $_POST['tipologia'], $_POST['comune'], $_POST['indirizzo'], $_POST['numeroLocali'], $_POST['numeroBagni'], $_POST['prezzo'], $_POST['dimensioni'], $_POST['numeroPostiAuto'], $_POST['annoCostruzione'], $_POST['pianiTotali'], $_POST['classeEnergetica'], $giardino, $ascensore, $balcone, $allarme, $inferriate, $portoncinoBlindato, $ariaCondizionata, $internet, $latitudine, $longitudine);

    // Esecuzione della query per ImmobiliResidenziali
    if ($stmtImmobili->execute()) {
        $codiceCatastale = $_POST['codiceCatastale'];

        // Preparazione della query per inserire i dati in AnnuncioIr
        $sqlAnnuncio = "INSERT INTO AnnuncioIr (titolo, tagsRicerca, descrizione, ImmobileR_id) VALUES (?, ?, ?, ?)";
        $stmtAnnuncio = $conn->prepare($sqlAnnuncio);
        $descrizione = $_POST['descrizione'] ?? 'Descrizione non fornita'; // Fornisce un valore di default
        $stmtAnnuncio->bind_param("ssss", $_POST['titolo'], $_POST['tagsRicerca'], $descrizione, $codiceCatastale);

        // Esecuzione della query per AnnuncioIr
        if ($stmtAnnuncio->execute()) {
            $idAnnuncioIr = $stmtAnnuncio->insert_id; // ID dell'annuncio inserito

            // Gestione upload immagini e inserimento in ImmaginiAnnuncio
            if (isset($_FILES['immagini']) && is_array($_FILES['immagini']['name'])) {
                $fileCount = count($_FILES['immagini']['name']);
                for ($i = 0; $i < $fileCount; $i++) {
                    if ($_FILES['immagini']['error'][$i] == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES['immagini']['tmp_name'][$i];
                        $name = basename($_FILES['immagini']['name'][$i]);
                        $target_file = "uploads/" . $name;
                        if (move_uploaded_file($tmp_name, $target_file)) {
                            $sqlImmagini = "INSERT INTO ImmaginiAnnuncio (pathImmagine, AnnuncioIr_id) VALUES (?, ?)";
                            $stmtImmagini = $conn->prepare($sqlImmagini);
                            $stmtImmagini->bind_param("si", $target_file, $idAnnuncioIr);
                            if (!$stmtImmagini->execute()) {
                                echo "Errore nell'inserimento immagine: " . $stmtImmagini->error;
                            }
                        } else {
                            echo "Errore nel caricamento dell'immagine.";
                        }
                    }
                }
            } else {
                echo "Nessuna immagine caricata.";
            }
        } else {
            echo "Errore nell'inserimento annuncio: " . $stmtAnnuncio->error;
        }
    } else {
        echo "Errore nell'inserimento immobile: " . $stmtImmobili->error;
    }

    $stmtImmobili->close();
    $stmtAnnuncio->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>verifica adminn</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<!-- Swiper's JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<style>
  /* Add custom styles for the logo and rounded divs if necessary */
  /* Hide the mobile menu by default */
  #mobile-menu {
    display: none;
    width: 100%;
    z-index: 50;
    background-color: #18182f;
  }

  /* Show the hamburger icon only on smaller screens */
  @media (max-width: 768px) {
    #hamburger-icon {
      display: block;
    }
    #desktop-menu {
      display: none;
    }
  }

  /* Show the full menu and hide the hamburger icon on larger screens */
  @media (min-width: 769px) {
    #hamburger-icon {
      display: none;
    }
    #desktop-menu {
      display: flex;
    }
  }
  /* New CSS */
@media (min-width: 769px) {
  #desktop-menu {
    align-items: center;
  }
}
.swiper-container {
  width: 100%;
  height: 100vh;
}
.swiper-slide {
  text-align: center;
  font-size: 18px;
  background: #fff;

  /* Center slide text vertically */
  display: -webkit-box;
  display: -ms-flexbox;
  display: -webkit-flex;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  -webkit-justify-content: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  -webkit-align-items: center;
  align-items: center;
}
.swiper-slide {
    background-size: cover;
    background-position: center;
    height: 100vh; /* This ensures that your slides are visible */
  }
  /* Fade in/out animation */
.menu-animate-enter {
  opacity: 0;
  transition: opacity 0.5s ease;
}

.menu-animate-enter-active {
  opacity: 1;
}

.menu-animate-exit {
  opacity: 1;
  transition: opacity 0.5s ease;
}

.menu-animate-exit-active {
  opacity: 0;
  pointer-events: none;
}
.flex.items-center {
  display: flex;
  align-items: center; /* This ensures vertical centering */
}

/* Directly within your style tag for dropdown positioning */
#userDropdown {
  top: 100%; /* Positions it right below the profile picture */
  right: 0; /* Aligns to the right; adjust as necessary */
}
@keyframes dropIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes dropOut {
  from {
    opacity: 1;
    transform: translateY(0);
  }
  to {
    opacity: 0;
    transform: translateY(-10px);
  }
}

/* Class for animating in */
.dropdown-animate-in {
  animation: dropIn 0.3s ease forwards;
}

/* Class for animating out */
.dropdown-animate-out {
  animation: dropOut 0.3s ease forwards;
}

/* Ensuring dropdown is above all */
#userDropdown {
  z-index: 100; /* Adjust this value as needed */
}
#menu-container {
            transition: max-height 0.7s ease-in-out;
            overflow-hidden: hidden;
            max-height: 0; /* Initially hidden */
        }
        #menu-container.max-h-full {
            max-height: 100vh; /* Adjust as needed */
        }
        .content {
            transition: opacity 0.5s ease;
            display: none; /* Initially hidden */
            opacity: 0;
        }
        .content.active {
            display: block; /* Shown */
            opacity: 1;
        }
        .transition-height {
            transition: max-height 0.5s ease;
        }
        
        /* Initially hide the content areas */
        .content {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        
        /* Class to toggle visibility */
        .content.visible {
            display: block;
            opacity: 1;
        }
        * Hide scrollbar for Chrome, Safari and Opera */
  .no-scrollbar::-webkit-scrollbar {
    display: none;
  }
  /* Hide scrollbar for IE, Edge and Firefox */
  .no-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
  }
  .scrollbar-thumb-blue {
    background: #3B82F6;
  }
  .scrollbar-track-blue-lighter {
    background: #E0F2FE;
  }
  /* Works on Firefox */
  * {
    scrollbar-width: thin;
    scrollbar-color: #3B82F6 #E0F2FE;
  }
  /* Works on Chrome, Edge, and Safari */
  *::-webkit-scrollbar {
    width: 12px;
  }
  *::-webkit-scrollbar-track {
    background: #E0F2FE;
  }
  *::-webkit-scrollbar-thumb {
    background-color: #3B82F6;
    border-radius: 20px;
    border: 3px solid #E0F2FE;
  }
  
  /* If necessary, additional styles to ensure the map has rounded corners */
  #map .leaflet-container {
    border-radius: 0.5rem; /* 8px */
  }
  /* Toggle Background */
  .toggle-bg {
    position: relative;
  }

  /* Toggle Dot */
  .toggle-dot {
    top: 0.5;
    left: 0.5;
    transition: transform 0.3s ease-in-out;
  }

  /* When the checkbox is checked, move the dot to the right */
  .peer:checked ~ .toggle-bg .toggle-dot {
    transform: translateX(1.25rem);
  }
  @keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.fade-in {
  animation: fadeIn 1s;
}
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.fade-in {
  animation: fadeIn 0.5s;
}
</style>
</style>
</head>
<body class=" bg-no-repeat bg-cover bg-center " style="background-image: url('background.svg')">
    <nav class="bg-[#18182f] border-[#000] dark:bg-[#18182f] sticky top-0 z-50">
        <div class=" bg-[#18182f] max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="index.html" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="agenLogo.svg" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Agenzia Montanelli</span>
        </a>
        <div class="flex md:order-2 bg-[#18182f] ">
        <!-- Hamburger icon -->
        <button id="hamburger-icon" type="button" class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <span class="sr-only">Open main menu</span>
        </button>
       
        <!-- Desktop menu -->
        <div id="desktop-menu" class="relative hidden md:block bg-[#18182f]">
            <!-- Menu items go here -->
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-[#18182f] md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-[#18182f] dark:bg-[#18182f] md:dark:bg-[#18182f] dark:border-gray-700">
                <li>
                  <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
                </li>
                <li>
                  <a href="chiSonoAgen.html" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">chi siamo</a>
                </li>
                
              </ul>
              
                
        </div>
        
          <!-- Dropdown Menu -->
          
      </div>
        
          
      </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="bg-[#18182f] relative hidden md:block transition-all ease-out duration-300">
            <!-- Menu items go here -->
            <ul class="bg-[#18182f] flex flex-col p-4 md:p-0 mt-4 font-medium border border-[#18182f] rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-[#18182f] dark:bg-gray-800 md:dark:bg-[#18182f] dark:border-gray-700">
              <li>
                <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
              </li>
              <li>
                <a href="chiSonoAgen.html" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">chi siamo</a>
              </li>
              </ul> 
            

        </div>
        </div>
    </nav>
    
    <section class="relative bg-center min-h-screen z-10 p-6">
        <div class="max-w-4xl mx-auto p-6 bg-gray-800 rounded-xl">
            <form id="pubblicaAnnuncio" name="pubblicaAnnuncio" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
              <h2 class="text-xl font-bold text-white mb-6">Pubblica un annuncio</h2>
              <div id="error-message" class="hidden text-red-500">Devi inserire un pin nella mappa</div>
              <!-- Row for Product Name and Tags -->
              <div class="flex flex-wrap -mx-3 mb-6">
                <!-- Product Name -->
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <label for="titolo" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2" for="product-name">
                    Titolo annuncio
                  </label>
                  <input required id="titolo" name="titolo" class="appearance-none block w-full bg-gray-700 text-white rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-gray-600" id="product-name" type="text" placeholder="inserisci titolo annuncio">
                </div>
                
                <!-- Tags -->
                <div class="w-full md:w-1/2 px-3">
                  <label for="tagsRicerca" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2" for="tags">
                    Tag di ricerca
                  </label>
                  <input id="tagsRicerca" name="tagsRicerca" class="appearance-none block w-full bg-gray-700 text-white rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600" id="tags" type="text" placeholder="es. appartamento, spazioso..">
                </div>
              </div>
              
              <!-- ...other fields similar to the above structure... -->
              
          
        
          
              
              <div class="flex flex-wrap -mx-3 mb-6">
                <!-- Property Type -->
                <div class="w-full lg:w-1/4 px-3 mb-6 md:mb-0">
                  <label for="tipologia" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2" for="property-type">
                    Tipologia immobile 
                  </label>
                  <select id="tipologia" name="tipologia" required class="block w-full bg-gray-700 text-white rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-gray-600" id="property-type">
                    <option>Appartamento</option>
                    <option>Villa Singola</option>
                    <option>Villa Bifamiliare</option>
                    <!-- Add more options here -->
                  </select>
                </div>
          
                <!-- Location -->
                <div class="w-full lg:w-3/4 px-3">
                  <label for="comune" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2" for="location">
                    Comune
                  </label>
                  <input id="comune" name="comune" required class="appearance-none block w-full bg-gray-700 text-white rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600" id="location" type="text" placeholder="inserisci il comune dell'immobile">
                </div>
                <div class="w-full lg:w-full px-3">
                  <label for="indirizzo" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2" for="location">
                    indirizzo
                  </label>
                  <input id="indirizzo" name="indirizzo" class="appearance-none block w-full bg-gray-700 text-white rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600" id="location" type="text" placeholder="inserisci l'indirizzo dell'immobile">
                  
                </div>
                <div class="w-full lg:w-full px-3 py-3">
                  <label for="codiceCatastale" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2" for="location">
                    Codice Catastale
                  </label>
                  <input id="codiceCatastale" name="codiceCatastale" class="appearance-none block w-full bg-gray-700 text-white rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600" id="location" type="text" placeholder="inserisci l'indirizzo dell'immobile">
                  
                </div>
              </div>
          
              <!-- Details Section -->
              <div class="flex flex-wrap -mx-3 mb-6">
                <!-- Bedrooms -->
                <div class="w-full md:w-1/4 px-3 py-3 mb-6 md:mb-0">
                  <label for="numeroLocali" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2" for="bedrooms">
                    numero locali
                  </label>
                  <input id="numeroLocali" name="numeroLocali" required class="appearance-none block w-full bg-gray-700 text-white rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600" id="bedrooms" type="number" placeholder="0">
                </div>
          
                <!-- Bathrooms -->
                <div class="w-full md:w-1/4 px-3 py-3 mb-6 md:mb-0">
                  <label for="numeroBagni" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2" for="bathrooms">
                    numero bagni
                  </label>
                  <input id="numeroBagni" name="numeroBagni" required class="appearance-none block w-full bg-gray-700 text-white rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600" id="bathrooms" type="number" placeholder="0">
                </div>
          
                <!-- Price -->
                <div class="w-full md:w-1/4 px-3 py-3 mb-6 md:mb-0">
                  <label for="prezzo" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2" for="price">
                    prezzo
                  </label>
                  <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <span class="text-gray-500 sm:text-sm">€</span>
                    </div>
                    <input id="prezzo" name="prezzo" required type="text" name="price" id="price" class="appearance-none block w-full bg-gray-700 text-white rounded py-3 px-4 pl-7 pr-12 sm:text-sm focus:outline-none focus:bg-gray-600" placeholder="0.00">
                  </div>
                </div>
          
                <!-- Size -->
                <div class="w-full md:w-1/4 px-3 py-3">
                  <label for="dimensioni" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2" for="size">
                    dimensioni (mq)
                  </label>
                  <input id="dimensioni" name="dimensioni"required class="appearance-none block w-full bg-gray-700 text-white rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600" id="size" type="number" placeholder="0">
                </div>
                <div class="w-full md:w-1/4 px-3 py-3">
                  <label for="numeroPostiAuto" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2" for="size">
                    numero posti auto
                  </label>
                  <input id="numeroPostiAuto" name="numeroPostiAuto" required class="appearance-none block w-full bg-gray-700 text-white rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600" id="size" type="number" placeholder="0">
                </div>
                <div class="w-full md:w-1/4 px-3 py-3">
                  <label for="annoCostruzione" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2" for="size">
                    anno costruzione
                  </label>
                  <input id="annoCostruzione" name="annoCostruzione" required class="appearance-none block w-full bg-gray-700 text-white rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600" id="size" type="number" placeholder="0">
                </div>
                <div class="w-full md:w-1/4 px-3 py-3">
                  <label for="pianiTotali" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2" for="size">
                    piani totali
                  </label>
                  <input id="pianiTotali" name="pianiTotali" required class="appearance-none block w-full bg-gray-700 text-white rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600" id="size" type="number" placeholder="0">
                </div>
                <div class="w-full lg:w-1/4 px-3 py-3">
                  <label for="classeEnergetica" class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2" for="property-type">
                    Classe energetica 
                  </label>
                  <select id="classeEnergetica"  name="classeEnergetica" required class="block w-full bg-gray-700 text-white rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-gray-600" id="property-type">
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                    <option>E</option>
                    <option>F</option>

                    <!-- Add more options here -->
                  </select>
                </div>
              </div>
              <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 mb-6">
                  <label class="block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2">
                    Caratteristiche
                  </label>
                  <!-- Amenities List -->
                  <div class="flex flex-wrap -m-2">
                    <!-- Dynamic width for toggle based on screen size -->
                    <div class="p-2 w-1/2 sm:w-1/3 md:w-1/4">
                      <label for="giardino" class="inline-flex items-center cursor-pointer">
                        <input id="giardino" name="giardino" type="checkbox" value="" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer dark:bg-gray-200 peer-checked:after:translate-x-full peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-300">Giardino</span>
                      </label>
                    </div>
                    <div class="p-2 w-1/2 sm:w-1/3 md:w-1/4">
                      <label for="ascensore" class="inline-flex items-center cursor-pointer">
                        <input  id="ascensore" name="ascensore" type="checkbox" value="" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer dark:bg-gray-200 peer-checked:after:translate-x-full peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-300">Ascensore</span>
                      </label>
                    </div>
                    <div class="p-2 w-1/2 sm:w-1/3 md:w-1/4">
                      <label for="balcone" class="inline-flex items-center cursor-pointer">
                        <input  id="balcone"  name="balcone" type="checkbox" value="" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer dark:bg-gray-200 peer-checked:after:translate-x-full peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-300">Balcone</span>
                      </label>
                    </div>
                    <div class="p-2 w-1/2 sm:w-1/3 md:w-1/4">
                      <label for="allarme" class="inline-flex items-center cursor-pointer">
                        <input id="allarme" name="allarme" type="checkbox" value="" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer dark:bg-gray-200 peer-checked:after:translate-x-full peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-300">Allarme</span>
                      </label>
                    </div>
                    <div class="p-2 w-1/2 sm:w-1/3 md:w-1/4">
                      <label for="inferriate" class="inline-flex items-center cursor-pointer">
                        <input id="inferriate" name="inferriate"  type="checkbox" value="" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer dark:bg-gray-200 peer-checked:after:translate-x-full peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-300">inferiate</span>
                      </label>
                    </div>
                    <div class="p-2 w-1/2 sm:w-1/3 md:w-1/4">
                      <label for="portoncinoBlindato" class="inline-flex items-center cursor-pointer">
                        <input id="portoncinoBlindato" name="portoncinoBlindato" type="checkbox" value="" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer dark:bg-gray-200 peer-checked:after:translate-x-full peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-300">Portoncino blindato</span>
                      </label>
                    </div>
                    <div class="p-2 w-1/2 sm:w-1/3 md:w-1/4">
                      <label for="ariaCondizionata" class="inline-flex items-center cursor-pointer">
                        <input id="ariaCondizionata" name="ariaCondizionata"  type="checkbox" value="" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer dark:bg-gray-200 peer-checked:after:translate-x-full peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-300">Aria condizionata</span>
                      </label>
                    </div>
                    <div class="p-2 w-1/2 sm:w-1/3 md:w-1/4">
                      <label for="internet" class="inline-flex items-center cursor-pointer">
                        <input  id="internet" name="internet" type="checkbox" value="" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer dark:bg-gray-200 peer-checked:after:translate-x-full peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-300">Internet</span>
                      </label>
                    </div>
                    
                    
                    <!-- Repeat for other amenities -->
                  </div>
                </div>
              </div>
              <!-- Map Section -->
              <div class="mb-6">
                <label class="block text-white text-lg font-semibold mb-2">
                  Mappa
                </label>
                <div id="map" class="h-64 rounded-lg overflow-hidden">
                  <!-- Your OpenStreetMap integration will go here -->
                  <!-- This is just a placeholder for the map -->
                  <div class="h-full w-full bg-gray-700 flex justify-center items-center text-white">
                    MAP
                  </div>
                </div>
              </div>
            
              <!-- Hidden Fields for Coordinates -->
              <input name="latitudine"  type="hidden" id="latitude" name="latitude" value="">
              <input name="longitudine"  type="hidden" id="longitude" name="longitude" value="">
              
              
              <!--description area-->
              <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                <div class="flex items-center justify-between px-3 py-2 border-b dark:border-gray-600">
                    <div class="flex flex-wrap items-center divide-gray-200 sm:divide-x sm:rtl:divide-x-reverse dark:divide-gray-600">
                        <div class="flex items-center space-x-1 rtl:space-x-reverse sm:pe-4">
                          <button type="button" id="attach-btn" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 20">
                              <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M1 6v8a5 5 0 1 0 10 0V4.5a3.5 3.5 0 1 0-7 0V13a2 2 0 0 0 4 0V6"/>
                            </svg>
                            <span class="sr-only">Attach file</span>
                          </button>
                          <!-- Hidden File input required -->
                          <input  type="file" id="file-input"  class="hidden" accept=".txt" />
                            
                            
                        </div>
                        <div class="flex flex-wrap items-center space-x-1 rtl:space-x-reverse sm:ps-4">
                            
                            
                        </div>
                    </div>
                    
                    <div id="tooltip-fullscreen" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Show full screen
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
                <div class="px-4 py-2 bg-white rounded-b-lg dark:bg-gray-800">
                    <label for="editor" class="sr-only">Publish post</label>
                    <textarea id="editor" name="descrizione" rows="8" class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Descrizione proprietà" required /></textarea>
                </div>
            </div>
              <!-- Badges and Indicators -->
              
              <!-- Photo Upload Section -->
              <div class="mb-6">
                <label class="block text-white text-lg font-semibold mb-2">
                  Upload your photos:
                </label>
                <div class="flex items-center justify-center w-full">
                  <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                      <div class="flex flex-col items-center justify-center pt-5 pb-6">
                          <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                          </svg>
                          <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                          <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                      </div>
                      <input  id="dropzone-file" name="immagini[]" type="file"  multiple onchange="handleFiles(this.files)" />
                  </label>
              </div> 
              </div>

              <!-- Image Preview Thumbnails -->
              <div id="gallery" class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <!-- Repeat this block for each image -->
                <div class="relative">
                  
                </div>
                
                <!-- ... more images ... -->
              </div>
             
          
              <!-- Submit Button -->
              <div class="flex justify-end mt-6">
                <button type="submit" class="px-6 py-2 rounded text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-50">
                  Add product
                </button>
              </div>
            </form>
          </div>
          
    </section>
      
  




    <footer class="bg-[#18182f] dark:bg-gray-900">
        <div class="bg-[#18182f] mx-auto w-full  p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
              <div class="mb-6 md:mb-0">
                  <a href="index.html" class="flex items-center">
                      <img src="agenLogo.svg" class="h-8 me-3" alt="FlowBite Logo" />
                      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Agenzia | Montanelli</span>
                  </a>
              </div>
              <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                 
                  <div>
                      <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">RISORSE</h2>
                      <ul class="text-gray-500 dark:text-gray-400 font-medium">
                          <li class="mb-4">
                              <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Aiuto</a>
                          </li>
                          <li>
                              <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Contatti</a>
                          </li>
                      </ul>
                  </div>
                  
              </div>
          </div>
          <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
          <div class="sm:flex sm:items-center sm:justify-between">
              <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">Marco Montanelli | 2023-2024
              </span>
              <div class="flex mt-4 sm:justify-center sm:mt-0">
                  
                <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                    <svg fill="currentColor" class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                        <path d="M32 6v20c0 1.135-0.865 2-2 2h-2v-18.151l-12 8.62-12-8.62v18.151h-2c-1.135 0-2-0.865-2-2v-20c0-0.568 0.214-1.068 0.573-1.422 0.359-0.365 0.859-0.578 1.427-0.578h0.667l13.333 9.667 13.333-9.667h0.667c0.568 0 1.068 0.214 1.427 0.578 0.359 0.354 0.573 0.854 0.573 1.422z"/>
                    </svg>
                    <span class="sr-only">New SVG Icon</span>
                </a>  
                <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                      <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 21 16">
                            <path d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z"/>
                        </svg>
                      <span class="sr-only">Discord community</span>
                  </a>
                  
                  <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                      <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
                      </svg>
                      <span class="sr-only">GitHub account</span>
                  </a>
                  
              </div>
          </div>
        </div>
    </footer>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    var hamburgerIcon = document.getElementById('hamburger-icon');
    var mobileMenu = document.getElementById('mobile-menu');

    hamburgerIcon.addEventListener('click', function() {
        const isMenuOpen = mobileMenu.classList.contains('menu-animate-enter-active');
        if (!isMenuOpen) {
            mobileMenu.classList.remove('menu-animate-exit', 'menu-animate-exit-active');
            mobileMenu.style.display = 'block';
            requestAnimationFrame(() => {
                mobileMenu.classList.add('menu-animate-enter', 'menu-animate-enter-active');
            });
        } else {
            mobileMenu.classList.remove('menu-animate-enter', 'menu-animate-enter-active');
            mobileMenu.classList.add('menu-animate-exit');
            setTimeout(() => {
                mobileMenu.classList.add('menu-animate-exit-active');
                mobileMenu.style.display = 'none';
            }, 500); // Match the CSS transition time
        }
    });
});
    
 
</script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const avatarButton = document.getElementById('avatarButton');
    const userDropdown = document.getElementById('userDropdown');

    avatarButton.addEventListener('click', () => {
        const isDropdownVisible = !userDropdown.classList.contains('hidden');
        if (isDropdownVisible) {
            userDropdown.classList.add('dropdown-animate-out');
            setTimeout(() => {
                userDropdown.classList.add('hidden');
                userDropdown.classList.remove('dropdown-animate-out');
            }, 300); // Match animation duration
        } else {
            userDropdown.classList.remove('hidden');
            userDropdown.classList.add('dropdown-animate-in');
        }
    });

    // Optional: Click outside to close with animation
    window.addEventListener('click', (e) => {
        if (!avatarButton.contains(e.target) && !userDropdown.contains(e.target) && !userDropdown.classList.contains('hidden')) {
            userDropdown.classList.add('dropdown-animate-out');
            setTimeout(() => {
                userDropdown.classList.add('hidden');
                userDropdown.classList.remove('dropdown-animate-out');
            }, 300); // Match animation duration
        }
    });
});
  </script>
  <script>
 // Function to toggle the height of the menu container
 

      document.addEventListener('DOMContentLoaded', (event) => {
    const toggleMenuBtn = document.getElementById('toggle-menu-btn');
    const searchFormBtn = document.getElementById('search-form-btn');
    const otherContentBtn = document.getElementById('other-content-btn');
    const menuContainer = document.getElementById('menu-container');
    const searchFormContent = document.getElementById('search-form-content');
    const otherContent = document.getElementById('other-content');

    toggleMenuBtn.addEventListener('click', function() {
      const isClosed = menuContainer.style.maxHeight === "" || menuContainer.style.maxHeight === "0px";
      menuContainer.style.maxHeight = isClosed ? "100%" : "0px";
    });

    searchFormBtn.addEventListener('click', function() {
      searchFormContent.classList.toggle('hidden', false); // Ensure the class is removed
      otherContent.classList.toggle('hidden', true); // Ensure the class is added
    });

    otherContentBtn.addEventListener('click', function() {
      otherContent.classList.toggle('hidden', false); // Ensure the class is removed
      searchFormContent.classList.toggle('hidden', true); // Ensure the class is added
    });
  });
  </script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var map = L.map('map').setView([51.505, -0.09], 13); // Default view
  
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
      }).addTo(map);
  
      var marker;
  
      function updateMarker(lat, lng) {
        if (marker) {
          marker.setLatLng([lat, lng]);
        } else {
          marker = L.marker([lat, lng]).addTo(map);
        }
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
      }
  
      map.on('click', function(e) {
        updateMarker(e.latlng.lat, e.latlng.lng);
      });
    });
  </script>
  <script>
   let fileArray = [];

// Function to handle new files selected by the user
function handleFiles(selectedFiles) {
    // Convert FileList to Array and iterate
    Array.from(selectedFiles).forEach(file => {
        // Ensure the file is an image
        if (file.type.startsWith('image/')) {
            // Add file to the array if it's not already present
            if (!fileArray.map(f => f.name).includes(file.name)) {
                fileArray.push(file);
            }
        }
    });

    updateGallery(); // Update the gallery with the new images
}

// Function to update the image gallery preview
function updateGallery() {
    const gallery = document.getElementById('gallery');
    gallery.innerHTML = ''; // Clear current contents

    // Create preview for each file in the array
    fileArray.forEach((file, index) => {
        const imgContainer = document.createElement('div');
        const img = document.createElement('img');
        const removeBtn = document.createElement('button');

        img.src = URL.createObjectURL(file);
        img.onload = () => URL.revokeObjectURL(img.src); // Free up memory
        img.classList.add('preview-img'); // Add any necessary classes

        // Configure the remove button
        removeBtn.innerText = 'Remove';
        removeBtn.onclick = () => {
            fileArray.splice(index, 1); // Remove file from array
            updateGallery(); // Refresh the gallery
        };

        imgContainer.appendChild(img);
        imgContainer.appendChild(removeBtn);
        gallery.appendChild(imgContainer);
    });
}

document.getElementById('dropzone-file').addEventListener('change', function(e) {
    handleFiles(e.target.files);
});
  </script>
  <script>
    document.getElementById('attach-btn').addEventListener('click', function() {
  document.getElementById('file-input').click();
});

document.getElementById('file-input').addEventListener('change', function() {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const textarea = document.getElementById('editor');
      textarea.classList.remove('fade-in'); // Reset animation
      void textarea.offsetWidth; // Trigger reflow to restart animation
      textarea.value = e.target.result;
      textarea.classList.add('fade-in');
    };
    reader.readAsText(file);
  }
});
  </script>
  <script>
    document.getElementById('pubblicaAnnuncio').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    // Create FormData object and append all form fields to it
    const formData = new FormData(this);

    // Append files from fileArray to formData
    fileArray.forEach((file, index) => {
        formData.append('immagini[]', file); // 'immagini[]' is the name attribute of your file input
    });

    // Include the latitude and longitude in formData if not already included
    formData.append('latitudine', document.getElementById('latitude').value);
    formData.append('longitudine', document.getElementById('longitude').value);

    // AJAX request to submit the form data
    fetch(this.action, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json()) // assuming your server responds with JSON
    .then(data => {
        console.log(data); // Handle success here (e.g., show a message)
    })
    .catch(error => {
        console.error('Submission error:', error); // Handle errors here
    });
});
    </script>
    

    <script>
      /*
    document.getElementById('pubblicaAnnuncio').addEventListener('submit', function(e) {
        // Se vuoi prevenire il submit del form per testare, decommenta la riga seguente.
        e.preventDefault();
        
        var files = document.getElementById('dropzone-file').files;
        console.log("Files selezionati:");
        
        // Stampa l'oggetto FileList
        console.log(files);
        
        // Itera sull'array dei files e stampa le proprietà di ogni file
        for (let i = 0; i < files.length; i++) {
            console.log(`File ${i}: ${files[i].name} (${files[i].size} bytes, type: ${files[i].type})`);
        }
    });
    */
    
    
</script>

</body>
</html>