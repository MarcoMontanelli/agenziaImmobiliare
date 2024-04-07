<?php
// Assuming you've got a PDO connection $pdo
try {
  // Connection to the database
  $pdo = new PDO('mysql:host=localhost;dbname=ageziamontanelli', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Adjusted SQL query to INCLUDE idAnnuncioIr
  $sql = "SELECT 
                a.idAnnuncioIr,  
                a.titolo, 
                a.descrizione, 
                a.tagsRicerca,
                a.dataCreazione, 
                a.dataUltimaModifica,
                ir.tipologia, 
                ir.comune, 
                ir.indirizzo, 
                ir.numeroLocali, 
                ir.numeroBagni, 
                ir.prezzo, 
                ir.dimensioni, 
                ir.numeroPostiAuto, 
                ir.annoCostruzione, 
                ir.pianiTotali, 
                ir.classeEnergetica, 
                ir.giardino, 
                ir.ascensore, 
                ir.balcone, 
                ir.allarme, 
                ir.inferriate, 
                ir.portoncinoBlindato, 
                ir.ariaCondizionata, 
                ir.internet, 
                ir.latitudine, 
                ir.longitudine,
                GROUP_CONCAT(i.pathImmagine) AS immagini
            FROM annuncioir a
            JOIN immobiliresidenziali ir ON a.ImmobileR_id = ir.codiceCatastale
            LEFT JOIN immaginiannuncio i ON a.idAnnuncioIr = i.AnnuncioIr_id
            GROUP BY a.idAnnuncioIr"; // Your query now includes idAnnuncioIr

  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Debug output to check if idAnnuncioIr is fetched correctly


} catch (PDOException $e) {
  die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>agenzia annunci</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  
  <!-- Swiper CSS and JS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
  
  <!-- Leaflet CSS and optional Leaflet Draw CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
  
  <!-- Flowbite CSS and JS -->
  <link href="https://cdn.jsdelivr.net/npm/flowbite@latest/dist/flowbite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/flowbite@latest/dist/flowbite.min.js"></script>
  
  <!-- Optional: Include datepicker JS if using the Flowbite date picker component specifically -->
  <script src="https://unpkg.com/flowbite@latest/dist/datepicker.js"></script>


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
      height: 100vh;
      /* This ensures that your slides are visible */
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
      align-items: center;
      /* This ensures vertical centering */
    }

    /* Directly within your style tag for dropdown positioning */
    #userDropdown {
      top: 100%;
      /* Positions it right below the profile picture */
      right: 0;
      /* Aligns to the right; adjust as necessary */
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
      z-index: 100;
      /* Adjust this value as needed */
    }

    #map {
      height: 400px;
    }

    #searchMenu {

      position: fixed;
      top: 4rem;
      /* Ensure this is the same as your navbar's height */
      left: 0;
      width: 100%;
      transform: translateY(-100%);
      /* Initial state - menu hidden */
      transition: transform 0.5s ease-in-out;
      z-index: 49;
      display: flex;
      flex-direction: column;
      max-height: 90vh;
      /* Example value, adjust as needed */
      overflow-y: auto;
      /* For scroll */
    }

    .slide-down {
      transform: translateY(0);
      /* Slide down to show menu */
    }

    #search-toggle-container {
      position: fixed;
      top: 4rem;
      /* Adjust this value to match the height of your navbar */
      left: 0;
      width: 100%;
      z-index: 40;
      /* Adjust if necessary to ensure it's above other content but below the search menu */
      transition: opacity 0.5s ease, visibility 0.5s ease;
      opacity: 1;
      visibility: visible;
    }

    /* This hides the toggle button when the search menu is active */
    #search-toggle-container.hidden {
      opacity: 0;
      visibility: hidden;
    }
  </style>
</head>

<body class="bg-[#1a1a3e]">

  <div class="min-h-screen flex flex-col">
    <div class="flex-grow">
      <nav class="bg-[#18182f] border-[#000] dark:bg-[#18182f] sticky top-0 z-50">
        <div class=" bg-[#18182f] max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
          <a href="index.html" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="agenLogo.svg" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Agenzia Montanelli</span>
          </a>
          <div class="flex md:order-2 bg-[#18182f] ">
            <!-- Hamburger icon -->
            <button id="hamburger-icon" type="button"
              class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
              </svg>
              <span class="sr-only">Open main menu</span>
            </button>

            <!-- Desktop menu -->
            <div id="desktop-menu" class="relative hidden md:block bg-[#18182f]">
              <!-- Menu items go here -->
              <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-[#18182f] md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-[#18182f] dark:bg-[#18182f] md:dark:bg-[#18182f] dark:border-gray-700">
                <li>
                  <a href="#"
                    class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500"
                    aria-current="page">Home</a>
                </li>
                <li>
                  <a href="chiSonoAgen.html"
                    class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">chi
                    siamo</a>
                </li>

              </ul>

              <form class="ml-4">
                <label for="default-search"
                  class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                  <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-6 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                  </div>
                  <input type="search" id="default-search"
                    class="block w-full p-4 ps-12 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cerca..." required>
                  <button type="submit" style="margin-left: 10px;"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
              </form>
            </div>
            <div class="relative ml-4 flex items-center"> <!-- Added for alignment and positioning -->
              <div class="relative inline-flex items-center">
                <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                  data-dropdown-placement="bottom-start"
                  class="w-10 h-10 rounded-full cursor-pointer border-2 border-gray-300" src="login.svg"
                  alt="User dropdown">
                <span
                  class="absolute top-0 right-0 inline-flex items-center justify-center w-4 h-4 text-xs font-semibold text-white bg-red-500 rounded-full border-2 border-white dark:border-gray-800">!</span>
              </div>
              <!-- Dropdown Menu -->
              <div id="userDropdown"
                class=" hidden absolute mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600"
                style="z-index: 100;">
                <!-- Dropdown content -->
                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                  <div>non hai effettuato accesso</div>
                  <div class="font-medium truncate">yourEmail@provider.com</div>
                </div>
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                  <li>
                    <a href="#"
                      class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">registrati</a>
                  </li>
                </ul>
                <div class="py-1">
                  <a href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">accedi</a>
                </div>
              </div>

            </div>


          </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="bg-[#18182f] relative hidden md:block transition-all ease-out duration-300">
          <!-- Menu items go here -->
          <ul
            class="bg-[#18182f] flex flex-col p-4 md:p-0 mt-4 font-medium border border-[#18182f] rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-[#18182f] dark:bg-gray-800 md:dark:bg-[#18182f] dark:border-gray-700">
            <li>
              <a href="#"
                class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500"
                aria-current="page">Home</a>
            </li>
            <li>
              <a href="chiSonoAgen.html"
                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">chi
                siamo</a>
            </li>
          </ul>
          <form class="bg-[#18182f] mt-4">
            <label for="default-search"
              class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
              </div>
              <input type="search" id="default-search"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search Mockups, Logos..." required>
              <button type="submit"
                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
          </form>

        </div>
    </div>

    </nav>
    <div id="search-toggle-container" class="bg-[#18182f] sticky top-[4rem] z-40">
      <button id="toggleSearch" class="flex justify-center items-center w-full p-2">
        <svg class="w-[50px] h-[50px] fill-[#8e8e8e]" viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z">
          </path>
        </svg>
      </button>
    </div>


    <div id="searchMenu"
      class="fixed top-0 left-0 w-full transform -translate-y-full transition-transform duration-500 ease-in-out z-50 max-h-screen overflow-y-auto bg-gray-900 bg-opacity-85 p-4">
      <div class="container mx-auto py-8">
        <div class="container mx-auto py-8">
          <div class="text-center mb-6">
            <h2 class="text-xl text-white font-bold">Cerca Immobili</h2>
          </div>
          <form id="searchForm" class="space-y-4 text-white">

            <div class="mb-6 w-full rounded mr-8" id="map" style="height: 400px;">
              <!-- The map code goes here -->
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">

              <!-- Tipologia -->
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="indirizzo">
                  Indirizzo
                </label>
                <input
                  class="appearance-none block w-full bg-gray-800 text-white border border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-700"
                  id="Indirizzo" type="text" placeholder="Es. Via Garibaldi">
              </div>

              <!-- Comune -->
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="comune">
                  Comune
                </label>
                <input
                  class="appearance-none block w-full bg-gray-800 text-white border border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-700"
                  id="comune" type="text" placeholder="Es. Milano">
              </div>
            </div>

            <!-- Numero Locali -->
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="numeroLocali">
                  Numero Locali
                </label>
                <input
                  class="appearance-none block w-full bg-gray-800 text-white border border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-700"
                  id="numeroLocali" type="number" placeholder="Es. 3">
              </div>

              <!-- Prezzo -->
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="prezzo">
                  Dimensioni (mq)
                </label>
                <input
                  class="appearance-none block w-full bg-gray-800 text-white border border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-700"
                  id="prezzo" type="number" placeholder="Es. 100">
              </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="pianiTotali">
                  Piani Totali
                </label>
                <input
                  class="appearance-none block w-full bg-gray-800 text-white border border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-700"
                  id="pianiTotali" type="number" placeholder="Es. 2">
              </div>

              <!-- Prezzo -->
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="numeroBagni">
                  Numero Bagni
                </label>
                <input
                  class="appearance-none block w-full bg-gray-800 text-white border border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-700"
                  id="Bagni" type="number" placeholder="Es. 1">
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="annoCostruzione">
                  Anno di costruzione
                </label>
                <input list="yearsList" id="annoCostruzione" name="annoCostruzione"
                  class="block appearance-none w-full bg-gray-800 text-white border border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-700"
                  placeholder="Select or type a year" />
                <datalist id="yearsList">
                  <!-- Options will be populated by JavaScript -->
                </datalist>
              </div>

              <!-- Prezzo -->
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="numeroPostiAuto">
                  Numero posti auto
                </label>
                <input
                  class="appearance-none block w-full bg-gray-800 text-white border border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-700"
                  id="postiAuto" type="number" placeholder="Es. 1">
              </div>
            </div>

            <!-- Classe Energetica -->
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2"
                  for="classeEnergetica">
                  Classe Energetica
                </label>
                <select
                  class="block appearance-none w-full bg-gray-800 text-white border border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-700"
                  id="classeEnergetica">
                  <option value="">Qualsiasi</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="E">E</option>
                  <option value="F">F</option>
                  <!-- Add more options as needed -->
                </select>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="Tipologia">
                  Tipologia
                </label>
                <select
                  class="block appearance-none w-full bg-gray-800 text-white border border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-700"
                  id="Tipologia">
                  <option value="">Qualsiasi</option>
                  <option value="A">Appartamento</option>
                  <option value="B">Villa Singola</option>
                  <option value="B">Villa Bifamiliare</option>
                  <!-- Add more options as needed -->
                </select>
              </div>
            </div>

            <!-- Features with Toggle Switches -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
              <div>
                <label class="inline-flex items-center cursor-pointer">
                  <input type="checkbox" id="feature_giardino" class="sr-only peer" />
                  <div
                    class="mr-2 w-11 h-6 bg-gray-600 rounded-full peer-checked:bg-blue-600 after:content-[''] after:block after:w-6 after:h-6 after:bg-white after:rounded-full after:transition-all peer-checked:after:translate-x-6 after:absolute after:transform after:-translate-x-1 after:duration-300">
                  </div>
                  Giardino
                </label>
              </div>
              <div>
                <label class="inline-flex items-center cursor-pointer">
                  <input type="checkbox" id="feature_giardino" class="sr-only peer" />
                  <div
                    class="mr-2 w-11 h-6 bg-gray-600 rounded-full peer-checked:bg-blue-600 after:content-[''] after:block after:w-6 after:h-6 after:bg-white after:rounded-full after:transition-all peer-checked:after:translate-x-6 after:absolute after:transform after:-translate-x-1 after:duration-300">
                  </div>
                  Ascensore
                </label>
              </div>
              <div>
                <label class="inline-flex items-center cursor-pointer">
                  <input type="checkbox" id="feature_giardino" class="sr-only peer" />
                  <div
                    class="mr-2 w-11 h-6 bg-gray-600 rounded-full peer-checked:bg-blue-600 after:content-[''] after:block after:w-6 after:h-6 after:bg-white after:rounded-full after:transition-all peer-checked:after:translate-x-6 after:absolute after:transform after:-translate-x-1 after:duration-300">
                  </div>
                  Balcone
                </label>
              </div>
              <div>
                <label class="inline-flex items-center cursor-pointer">
                  <input type="checkbox" id="feature_giardino" class="sr-only peer" />
                  <div
                    class="mr-2 w-11 h-6 bg-gray-600 rounded-full peer-checked:bg-blue-600 after:content-[''] after:block after:w-6 after:h-6 after:bg-white after:rounded-full after:transition-all peer-checked:after:translate-x-6 after:absolute after:transform after:-translate-x-1 after:duration-300">
                  </div>
                  Allarme
                </label>
              </div>
              <div>
                <label class="inline-flex items-center cursor-pointer">
                  <input type="checkbox" id="feature_giardino" class="sr-only peer" />
                  <div
                    class="mr-2 w-11 h-6 bg-gray-600 rounded-full peer-checked:bg-blue-600 after:content-[''] after:block after:w-6 after:h-6 after:bg-white after:rounded-full after:transition-all peer-checked:after:translate-x-6 after:absolute after:transform after:-translate-x-1 after:duration-300">
                  </div>
                  Inferriate
                </label>
              </div>
              <div>
                <label class="inline-flex items-center cursor-pointer">
                  <input type="checkbox" id="feature_giardino" class="sr-only peer" />
                  <div
                    class="mr-2 w-11 h-6 bg-gray-600 rounded-full peer-checked:bg-blue-600 after:content-[''] after:block after:w-6 after:h-6 after:bg-white after:rounded-full after:transition-all peer-checked:after:translate-x-6 after:absolute after:transform after:-translate-x-1 after:duration-300">
                  </div>
                  Portoncino blindato
                </label>
              </div>
              <div>
                <label class="inline-flex items-center cursor-pointer">
                  <input type="checkbox" id="feature_giardino" class="sr-only peer" />
                  <div
                    class="mr-2 w-11 h-6 bg-gray-600 rounded-full peer-checked:bg-blue-600 after:content-[''] after:block after:w-6 after:h-6 after:bg-white after:rounded-full after:transition-all peer-checked:after:translate-x-6 after:absolute after:transform after:-translate-x-1 after:duration-300">
                  </div>
                  Aria condizionata
                </label>
              </div>
              <div>
                <label class="inline-flex items-center cursor-pointer">
                  <input type="checkbox" id="feature_giardino" class="sr-only peer" />
                  <div
                    class="mr-2 w-11 h-6 bg-gray-600 rounded-full peer-checked:bg-blue-600 after:content-[''] after:block after:w-6 after:h-6 after:bg-white after:rounded-full after:transition-all peer-checked:after:translate-x-6 after:absolute after:transform after:-translate-x-1 after:duration-300">
                  </div>
                  internet
                </label>
              </div>

              <!-- Repeat for other features -->
            </div>

            <!-- Range Slider -->
            <div class="flex flex-col space-y-4 p-4">
              <!-- Slider Container -->
              <div class="relative">
                <!-- Slider -->
                <input type="range" id="priceSlider" min="0" max="1000000" value="50000" step="10000"
                  class="range range-primary w-full" oninput="updateSliderValue()">
                <!-- Labels Container -->
                <div class="flex justify-between text-xs px-2" id="priceLabels"></div>
              </div>

              <!-- Current Value Input -->
              <div>
                <label for="currentValue" class="inline-flex items-center cursor-pointer">Prezzo massimo €</label>
                <input type="number" id="currentValue"
                  class="mt-1 block w-full bg-gray-800 text-white border border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-700"
                  onchange="updateFromCurrentValue()">
              </div>

              <!-- Max Range Inputs -->
              <div class="flex space-x-4">
                <div class="flex-1">
                  <label for="maxRange" class="inline-flex items-center cursor-pointer">Intervallo massimo €</label>
                  <input type="number" id="maxRange"
                    class="mt-1 block w-full bg-gray-800 text-white border border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-700"
                    value="1000000" onchange="updateMaxRange()">
                </div>
              </div>
            </div>
            <input type="hidden" id="drawnAreaCoords" name="drawnAreaCoords">
            <!-- Search Button -->
            <div class="flex justify-end mt-6">
              <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Cerca
              </button>
              <button id="toggleGeolocation"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">Toggle
                Geolocation</button>
            </div>
          </form>
        </div>
        <button id="closeSearch" class="flex justify-center items-center w-full p-2">
          <svg class="w-[50px] h-[50px] fill-[#8e8e8e]" viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M182.6 137.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z">
            </path>
          </svg>
        </button>
      </div>
    </div>



    
    <div class="px-4 md:px-8 lg:px-16 xl:px-24">
    <?php foreach ($results as $row): ?>
        <?php
        $images = explode(',', $row['immagini']);
        $mainImage = !empty($images[0]) ? htmlspecialchars($images[0]) : 'path/to/default/image.png';
        ?>
        <div class="mt-16 mb-8 bg-gradient-to-tl from-slate-900 via-gray-800 to-slate-600 shadow-3xl rounded-lg overflow-hidden md:flex md:h-auto">
            <div class="md:w-1/4 bg-gray-900 p-4 rounded-lg">
                <!-- Main Image -->
                <div class="aspect-w-16 aspect-h-9 mb-2 md:mb-4">
                    <img class="object-cover w-full h-full rounded-lg" src="<?php echo $mainImage; ?>" alt="Property Image">
                </div>

                <!-- Secondary Images -->
                <div class="flex -mx-2">
                    <?php for ($i = 1; $i <= 2; $i++): ?>
                        <?php if (!empty($images[$i])): ?>
                            <div class="flex-1 px-2">
                                <div class="aspect-w-16 aspect-h-9">
                                    <img class="object-cover w-full h-full rounded-lg" src="<?php echo htmlspecialchars($images[$i]); ?>" alt="Property Image">
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>

      <!-- Content container -->
      <div class="md:w-3/4 p-4 bg-gray-800 flex flex-col justify-between">
        <div>
          <!-- Title and Description -->
          <h2 class="text-4xl text-white font-bold"><?php echo htmlspecialchars($row['titolo']); ?></h2>
          <div class="text-blue-300 font-bold text-4xl mb-2">€
                    <?php echo htmlspecialchars($row['prezzo']); ?>
                  </div>
          <p class="text-gray-200 mt-4 mb-2"><?php echo htmlspecialchars($row['descrizione']); ?></p>
          <hr class="my-4">
          <!-- Icons Grid -->
          <div class="grid grid-cols-3 gap-4 text-gray-200 mb-4">
          
        <?php
                // Define your features and associated icons here
                $featuresWithIcons = [
                  'giardino' => 'fas fa-seedling',
                  'ascensore' => 'fas fa-elevator',
                  'balcone' => 'fas fa-th-large',
                  'allarme' => 'fas fa-bell',
                  'inferriate' => 'fas fa-window-close',
                  'portoncinoBlindato' => 'fas fa-door-closed',
                  'ariaCondizionata' => 'fas fa-wind',
                  'internet' => 'fas fa-wifi',
                ];

                foreach ($featuresWithIcons as $feature => $icon) {
                  if (!empty($row[$feature])) {
                    echo "<div class='flex items-center'><i class='{$icon} mr-2'></i><span>" . ucfirst($feature) . "</span></div>";
                  }
                }
                ?>
                <div><strong>Locali:</strong> <span></span>
                  <?php echo htmlspecialchars(json_encode($row['numeroLocali'])); ?>
                </div>
                <div><strong>Bagni:</strong> <span></span>
                  <?php echo htmlspecialchars(json_encode($row['numeroBagni'])); ?>
                </div>
                <div><strong>Posti Auto:</strong> <span></span>
                  <?php echo htmlspecialchars(json_encode($row['numeroPostiAuto'])); ?>
                </div>
                <div><strong>Anno di Costruzione:</strong> <span></span>
                  <?php echo htmlspecialchars(json_encode($row['annoCostruzione'])); ?>
                </div>
                <div><strong>Piani Totali:</strong> <span></span>
                  <?php echo htmlspecialchars(json_encode($row['pianiTotali'])); ?>
                </div>
                <div><strong>Classe Energetica:</strong> <span></span>
                  <?php echo htmlspecialchars(json_encode($row['classeEnergetica'])); ?>
                </div>
                <div><strong>Dimensioni:</strong> <span></span>
                  <?php echo htmlspecialchars(json_encode($row['dimensioni'])); ?> mq
                </div>
                
        
          </div>
        </div>

        <!-- Map Container -->
        <div id="map<?php echo $row['idAnnuncioIr']; ?>" class="h-80 mb-4"></div>


        <!-- Action Buttons -->
        <div class="flex space-x-4">
        <button class="bg-blue-500 text-white hover:bg-blue-700 font-bold py-2 px-4 rounded">MESSAGGIO</button>
        <button id="popoverButton<?php echo $row['idAnnuncioIr']; ?>" data-popover-target="popoverContent<?php echo $row['idAnnuncioIr']; ?>" type="button" class=" text-white relative bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">
    VISITA
</button>

<!-- Popover Content -->
<div id="popoverContent<?php echo $row['idAnnuncioIr']; ?>" class="hidden absolute z-[1050] bg-gray-900 text-gray-100 rounded shadow-lg w-auto">
    <!-- Date Picker Here -->
    <div class="p-4">
        <div inline-datepicker data-date="<?php echo date('m/d/Y'); ?>" class="date-picker"></div>
    </div>
</div>
          <button class="hover:text-gray-400 text-white">
            <i class="far fa-heart"></i>
          </button>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // Query all elements with the 'data-popover-target' attribute
  document.querySelectorAll('[data-popover-target]').forEach(triggerEl => {
    // Use the trigger element's 'data-popover-target' attribute value to find the target popover
    const targetId = triggerEl.getAttribute('data-popover-target');
    const targetEl = document.getElementById(targetId);

    // Check if both elements exist
    if (triggerEl && targetEl) {
      triggerEl.addEventListener('click', () => {
        // Toggle visibility of the target element
        const isVisible = targetEl.classList.contains('hidden');
        targetEl.classList.toggle('hidden', !isVisible);
      });
    }
  });
});
</script>





   















    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var hamburgerIcon = document.getElementById('hamburger-icon');
        var mobileMenu = document.getElementById('mobile-menu');

        hamburgerIcon.addEventListener('click', function () {
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
      document.addEventListener("DOMContentLoaded", function () {
        var swiper = new Swiper('.swiper-container', {
          loop: true,
          autoplay: {
            delay: 2500,
            disableOnInteraction: false,
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          effect: 'fade', // Optional: Adds a fade effect between slides
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


      document.addEventListener('DOMContentLoaded', () => {
        const toggleSearch = document.getElementById('toggleSearch');
        const closeSearch = document.getElementById('closeSearch');
        const searchMenu = document.getElementById('searchMenu');
        const searchToggleContainer = document.getElementById('search-toggle-container'); // Ensure this ID is correct in your HTML

        // Function to open the search menu
        function openSearchMenu() {
          searchMenu.classList.add('slide-down');
          searchMenu.style.transform = 'translateY(0)';
          searchToggleContainer.classList.add('hidden'); // Hide the toggle button
        }

        // Function to close the search menu
        function closeSearchMenu() {
          searchMenu.classList.remove('slide-down');
          searchMenu.style.transform = 'translateY(-100%)';
          searchToggleContainer.classList.remove('hidden'); // Show the toggle button
        }

        toggleSearch.addEventListener('click', openSearchMenu);
        closeSearch.addEventListener('click', closeSearchMenu);
      });


    </script>

    <footer class="bg-[#18182f] dark:bg-gray-900">
      <div class="bg-[#18182f] mx-auto w-full  p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
            <a href="index.html" class="flex items-center">
              <img src="agenLogo.svg" class="h-8 me-3" alt="FlowBite Logo" />
              <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Agenzia |
                Montanelli</span>
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
              <svg fill="currentColor" class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 32 32">
                <path
                  d="M32 6v20c0 1.135-0.865 2-2 2h-2v-18.151l-12 8.62-12-8.62v18.151h-2c-1.135 0-2-0.865-2-2v-20c0-0.568 0.214-1.068 0.573-1.422 0.359-0.365 0.859-0.578 1.427-0.578h0.667l13.333 9.667 13.333-9.667h0.667c0.568 0 1.068 0.214 1.427 0.578 0.359 0.354 0.573 0.854 0.573 1.422z" />
              </svg>
              <span class="sr-only">New SVG Icon</span>
            </a>
            <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
              <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 21 16">
                <path
                  d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
              </svg>
              <span class="sr-only">Discord community</span>
            </a>

            <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
              <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                  clip-rule="evenodd" />
              </svg>
              <span class="sr-only">GitHub account</span>
            </a>

          </div>
        </div>
      </div>
    </footer>
  </div>





  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      <?php foreach ($results as $row): ?>
          // Initialize map for each property
          (function () {
            var mapId = 'map<?php echo $row['idAnnuncioIr']; ?>';
            if (document.getElementById(mapId)) {
              var map = L.map(mapId).setView([<?php echo $row['latitudine']; ?>, <?php echo $row['longitudine']; ?>], 13);
              L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
              }).addTo(map);
              L.marker([<?php echo $row['latitudine']; ?>, <?php echo $row['longitudine']; ?>]).addTo(map);
            }
          })();

        // Initialize calendar for each property
        (function () {
          var calendarId = 'calendar<?php echo $row['idAnnuncioIr']; ?>';
          if (document.getElementById(calendarId)) {
            let today = new Date();
            let month = today.getMonth();
            let year = today.getFullYear();

            function daysInMonth(month, year) {
              return new Date(year, month + 1, 0).getDate();
            }

            let days = daysInMonth(month, year);
            let firstDayOfMonth = new Date(year, month, 1).getDay();

            let calendarHtml = '<div class="text-center">' + year + '-' + (month + 1) + '</div><div class="grid grid-cols-7 gap-1">';

            // Empty slots for days of the week before the first day of the month
            for (let i = 0; i < firstDayOfMonth; i++) {
              calendarHtml += '<div></div>';
            }

            // Days of the month
            for (let day = 1; day <= days; day++) {
              calendarHtml += `<div class="p-2 bg-gray-800 rounded">${day}</div>`;
            }

            calendarHtml += '</div>';
            document.getElementById(calendarId).innerHTML = calendarHtml;
          }
        })();
      <?php endforeach; ?>
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {



      var map = L.map('map').setView([45.72846, 9.54979], 13);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      var personIcon = L.icon({
        iconUrl: 'person-pin-circle_118813.png', // Make sure the path is correct
        iconSize: [30, 30]
      });

      var houseIcon = L.icon({
        iconUrl: 'fullhouse_house_4913.png', // Make sure the path is correct
        iconSize: [25, 25]
      });

      <?php foreach ($results as $row): ?>
        <?php
        $images = explode(',', $row['immagini']);
        $firstImage = !empty($images[0]) ? $images[0] : 'path/to/default/image.png'; // Replace 'path/to/default/image.png' with your actual default image path
        ?>
        var marker = L.marker([<?php echo $row['latitudine']; ?>, <?php echo $row['longitudine']; ?>], { icon: houseIcon }).addTo(map);
        marker.bindPopup("<div style='text-align: center;'><b><?php echo htmlspecialchars($row['titolo']); ?></b><br><img src='<?php echo htmlspecialchars($firstImage); ?>' style='width:100%; max-width: 200px;'><br><?php echo htmlspecialchars($row['descrizione']); ?><br>€<?php echo htmlspecialchars($row['prezzo']); ?></div>");
      <?php endforeach; ?>


      var drawnItems = new L.FeatureGroup();
      map.addLayer(drawnItems);

      var drawControl = new L.Control.Draw({
        draw: {
          polygon: {
            shapeOptions: {
              color: 'rgba(0, 0, 255, 0.5)',
              fillOpacity: 0.7
            }
          },
          polyline: false,
          rectangle: false,
          circle: false,
          marker: false
        },
        edit: {
          featureGroup: drawnItems,
          remove: true
        }
      });
      map.addControl(drawControl);

      map.on('draw:created', function (e) {
        drawnItems.clearLayers(); // This removes previous drawings
        drawnItems.addLayer(e.layer);
      });

      // Check if the years list and toggle button exist before trying to use them
      const yearsList = document.getElementById('yearsList');
      if (yearsList) {
        const currentYear = new Date().getFullYear();
        for (let i = 0; i < 30; i++) {
          let year = currentYear - i;
          let option = document.createElement('option');
          option.value = year;
          yearsList.appendChild(option);
        }
      }

      let geoMarker = null;
      document.getElementById('toggleGeolocation')?.addEventListener('click', function () {
        if (geoMarker !== null) {
          map.removeLayer(geoMarker);
          geoMarker = null;
        } else {
          navigator.geolocation.getCurrentPosition(function (position) {
            var userLocation = [position.coords.latitude, position.coords.longitude];
            map.setView(userLocation, 16); // Zoom into the user's location

            if (!geoMarker) {
              geoMarker = L.marker(userLocation, { icon: personIcon }).addTo(map);
            } else {
              geoMarker.setLatLng(userLocation);
            }
          }, function (error) {
            console.error("Geolocation error:", error);
          }, {
            enableHighAccuracy: true
          });
        }
      });

    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const slider = document.getElementById('priceSlider');
      const currentValue = document.getElementById('currentValue');
      const maxRange = document.getElementById('maxRange');
      const priceLabels = document.getElementById('priceLabels');

      // Ensure elements exist
      if (!slider || !currentValue || !maxRange || !priceLabels) {
        console.error('One or more elements are missing.');
        return;
      }

      function updateSliderValue() {
        currentValue.value = slider.value;
        generateLabels();
      }

      function updateFromCurrentValue() {
        let value = parseInt(currentValue.value);
        if (isNaN(value)) value = 0;
        if (value > parseInt(maxRange.value)) {
          maxRange.value = Math.ceil(value / 100000) * 100000; // Adjust max to the next 100k if needed
          slider.max = maxRange.value;
        }
        slider.value = value;
        generateLabels();
      }

      function updateMaxRange() {
        let value = parseInt(maxRange.value);
        if (isNaN(value) || value < parseInt(slider.value)) value = parseInt(slider.value);
        slider.max = value;
        generateLabels();
      }

      function generateLabels() {
        priceLabels.innerHTML = ''; // Clear existing labels
        const max = parseInt(slider.max);
        const step = Math.max(20000, Math.round(max / 10)); // Adjust step for labels
        for (let i = 0; i <= max; i += step) {
          const label = document.createElement('span');
          label.textContent = `€${i.toLocaleString()}`;
          label.className = 'text-xs';
          priceLabels.appendChild(label);
        }
      }

      // Attach event listeners
      slider.addEventListener('input', updateSliderValue);
      currentValue.addEventListener('input', updateFromCurrentValue);
      maxRange.addEventListener('change', updateMaxRange);

      // Initial setup
      generateLabels();
      updateSliderValue();
    });

  </script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var geocoder = new L.Control.Geocoder.Nominatim();

      function suggest(query, updateResults, type) {
        geocoder.geocode(query, function (results) {
          const filteredResults = results.filter(result => result.properties.address.country_code === 'it');
          updateResults(filteredResults, type);
        });
      }

      function formatResult(result, type) {
        // Custom formatting for address and commune inputs
        if (type === 'address') {
          // For addresses, show only the street name if available
          return result.properties.address.road || result.name;
        } else if (type === 'comune') {
          // For communes, show the commune name
          return result.name.split(',')[0]; // Assuming the first part is the commune name
        }
        return result.name;
      }

      function attachAutocomplete(inputId, type) {
        var input = document.getElementById(inputId);
        var suggestionsBox = document.createElement('div');
        suggestionsBox.classList.add('absolute', 'z-10', 'bg-gray-800', 'text-white', 'border', 'border-gray-600', 'rounded-md', 'max-h-60', 'overflow-y-auto', 'mt-1');
        suggestionsBox.style.width = input.offsetWidth + 'px'; // Match the input field's width
        input.parentNode.position = 'relative';
        input.parentNode.appendChild(suggestionsBox);

        input.addEventListener('input', function () {
          var query = this.value;
          if (query.length < 3) {
            suggestionsBox.innerHTML = '';
            return;
          }
          suggest(query, function (results, type) {
            suggestionsBox.innerHTML = '';
            results.forEach(function (result) {
              var suggestionItem = document.createElement('div');
              suggestionItem.classList.add('py-2', 'px-4', 'hover:bg-gray-700', 'cursor-pointer', 'truncate');
              suggestionItem.textContent = formatResult(result, type);
              suggestionItem.onclick = function () {
                input.value = formatResult(result, type);
                suggestionsBox.innerHTML = '';
              };
              suggestionsBox.appendChild(suggestionItem);
            });
          }, type);
        });

        document.addEventListener('click', function (e) {
          if (!input.contains(e.target)) {
            suggestionsBox.innerHTML = '';
          }
        });
      }
      console.log(document.getElementById('Indirizzo')); // should not be null
      console.log(document.getElementById('comune'));
      attachAutocomplete('Indirizzo', 'address');
      attachAutocomplete('comune', 'comune');
    });
  </script>


</body>

</html>