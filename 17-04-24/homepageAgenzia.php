<?php
session_start();

// Assuming user type is stored in session or cookie as 'user_type'
$userType = $_SESSION['user_type'] ?? $_COOKIE['user_type'] ?? null;

if ($userType) {
    switch ($userType) {
        case 'admin':
            header("Location: adminPaginaH.php");
            break;
        case 'client':
            header("Location: clientePaginaH.php");
            break;
        case 'agency':
            header("Location: agenziaPaginaH.php");
            break;
        // Add more cases as needed
        
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EchoGenix | AI companion</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

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
</style>
</head>
<body class="bg-[#1a1a3e]">
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
              
                <form class="ml-4">   
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-6 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" id="default-search" class="block w-full p-4 ps-12 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cerca..." required>
                        <button type="submit" style="margin-left: 10px;" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>
        </div>
        <div class="relative ml-4 flex items-center"> <!-- Added for alignment and positioning -->
          <div class="relative inline-flex items-center">
            <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer border-2 border-gray-300" src="login.svg" alt="User dropdown">
            <span class="absolute top-0 right-0 inline-flex items-center justify-center w-4 h-4 text-xs font-semibold text-white bg-red-500 rounded-full border-2 border-white dark:border-gray-800">!</span>
        </div>
          <!-- Dropdown Menu -->
          <div id="userDropdown" class=" hidden absolute mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600" style="z-index: 100;">
              <!-- Dropdown content -->
              <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                <div>non hai effettuato accesso</div>
                <div class="font-medium truncate">yourEmail@provider.com</div>
              </div>
              <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                <li>
                  <a href="registerC.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">registrati</a>
                </li>
              </ul>
              <div class="py-1">
                <a href="loginup.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">accedi</a>
              </div>
          </div>
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
            <form class="bg-[#18182f] mt-4">   
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required>
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>

        </div>
        </div>
    </nav>
    




    <section class="relative bg-center min-h-screen z-10">
      <div id="marketing-banner" tabindex="-1" class="sticky top-0 z-30 flex items-center justify-between w-full px-4 md:px-8 py-2 bg-white border border-gray-100 rounded-lg shadow dark:bg-gray-700 dark:border-gray-600">
        <div class="flex flex-col items-start mb-3 me-4 md:items-center md:flex-row md:mb-0">
            <a href="registerC.php" class="flex items-center mb-2 border-gray-200 md:pe-4 md:me-4 md:border-e md:mb-0 dark:border-gray-600">
                <img src="agenLogo.svg" class="h-6 me-2" alt="Flowbite Logo">
                <span class="self-center text-lg font-semibold whitespace-nowrap dark:text-white">Agenzia Montanelli</span>
            </a>
            <p class="flex items-center text-sm font-normal text-gray-500 dark:text-gray-400">registrati per ricevere aggiornamenti</p>
        </div>
        <div class="flex items-center flex-shrink-0">
            <a href="registerC.php" class="px-5 py-2 me-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Sign up</a>
            <button data-dismiss-target="#marketing-banner" type="button" class="flex-shrink-0 inline-flex justify-center w-7 h-7 items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close banner</span>
            </button>
        </div>
      </div>
      <!-- Swiper -->
      <div class="swiper-container ">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide" style="background-image: url('casa1.jpeg');"></div>
          <div class="swiper-slide" style="background-image: url('casa2.jpg');"></div>
          <div class="swiper-slide" style="background-image: url('casa3.jpg');"></div>
          <!-- etc. -->
        </div>
        <!-- If you want navigation buttons -->
        
      </div>
      
      <!-- Overlay Content -->
      <div class="absolute top-0 left-0 right-0 bottom-0 flex flex-col justify-center items-center text-center p-4 z-10">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl lg:text-6xl text-white">
          Un'agenzia per tutti.
        </h1>
        <p class="mb-8 text-lg font-normal lg:text-xl sm:px-16 lg:px-48 text-white">
          registrati come privato o come azienda e inizia subito a postare annunci o a visualizzarli.
        </p>
        <div class="flex flex-col space-y-4 lg:flex-row justify-center sm:space-y-0">
          <a href="registerC.php" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-opacity-90 bg-parpol hover:bg-electric-violet focus:ring-4 focus:ring-electric-violet">
            registrati
          </a>
          <a href="loginup.php" class="bg-blue-600 justify-center items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-electric-violet focus:ring-4 focus:ring-electric-violet bg-opacity-90">
            accedi
          </a>
        </div>
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
  document.addEventListener("DOMContentLoaded", function() {
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
window.onload = function() {
    const userType = getCookie('user_type');

    if (userType) {
        switch (userType) {
            case 'admin':
                window.location.href = 'adminPaginaH.php';
                break;
            case 'client':
                window.location.href = 'clientePaginaH.php';
                break;
            case 'agency':
                window.location.href = 'agenziaPaginaH.php';
                break;
            // Add more cases as needed
            default:
                // Optional: Redirect to a default page if user type is unknown
                window.location.href = 'defaultPage.html';
        }
    }
}

function getCookie(name) {
    let cookieArray = document.cookie.split(';');
    for (let i = 0; i < cookieArray.length; i++) {
        let cookiePair = cookieArray[i].split('=');
        if (name == cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}
</script>
</body>
</html>
