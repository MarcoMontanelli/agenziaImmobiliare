<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$adminId = $_GET['adminId'] ?? null;

// Redirect if adminId is not present
if (!$adminId) {
    header("Location: debugPage.php"); // Redirect to a debug or error page as needed
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $verificationCode = $_POST['verificationCode'];

    // Prepare statement to check the verification code
    $stmtCheckVerification = $conn->prepare("SELECT * FROM verificaad WHERE id_admin = ?");
    $stmtCheckVerification->bind_param("i", $adminId);
    $stmtCheckVerification->execute();
    $result = $stmtCheckVerification->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        if ($verificationCode == $row['codiceVerifica']) {
            if ($row['scadenza'] > date('Y-m-d H:i:s')) {
                // Verification successful, update ADMIN table and delete verification record
                $updateAdmin = $conn->prepare("UPDATE ADMIN SET verificato = 1 WHERE idAdmin = ?"); // Make sure the column and table names are correct
                $updateAdmin->bind_param("i", $adminId);
                $updateAdmin->execute();

                $stmtDeleteVerification = $conn->prepare("DELETE FROM verificaad WHERE id_admin = ?");
                $stmtDeleteVerification->bind_param("i", $adminId);
                $stmtDeleteVerification->execute();

                echo "Verification successful! Redirecting to home...";
                header("Refresh: 3; URL=debugPage.php"); // Adjust the redirect URL as needed
                exit();
            } else {
                // Verification code expired, delete record
                $stmtDeleteExpired = $conn->prepare("DELETE FROM verificaad WHERE id_admin = ? AND scadenza <= ?");
                $currentTime = date('Y-m-d H:i:s');
                $stmtDeleteExpired->bind_param("is", $adminId, $currentTime);
                if ($stmtDeleteExpired->execute()) {
                    echo "Verification code expired. Record deleted.";
                    header("Refresh: 3; URL=debugPage.php"); // Redirect as needed
                    exit();
                } else {
                    echo "Error deleting expired verification record.";
                }
            }
        } else {
            echo "<script>alert('Verification code is invalid!');</script>";
        }
    } else {
        echo "<script>alert('No verification record found!');</script>";
    }
}

$conn->close();
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
</style>
</head>
<body class=" bg-no-repeat bg-cover bg-center" style="background-image: url('background.svg')">
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
    
  
      
  



    <section class="relative bg-center min-h-screen z-10">
    <div class="min-h-screen flex items-center justify-center ">
  <div class="container max-w-4xl shadow-2xl bg-white rounded-xl mx-4 md:mx-auto">
    <div class="flex flex-wrap overflow-hidden rounded-xl">
      
      <!-- Form centered with logo -->
      <div class="w-full md:w-1/2 p-6 flex flex-col justify-center">
        <div class="flex items-center justify-center md:justify-start space-x-3 mb-6">
          <img src="agenLogo.svg" alt="Your Logo" class="h-16 w-16 rounded-full"> <!-- Logo -->
          <h2 class="text-lg font-medium text-gray-900">Verifica Admin</h2>
        </div>
        <div class="w-full max-w-xs mx-auto md:mx-0">
          <form action="" method="post" class="mt-4" id="verificationForm">
            <input type="hidden" name="agencyId" value="<?php echo $agencyId; ?>">

            <label for="verificationCode" class="block text-sm font-medium text-gray-700">Codice di Verifica:</label>
            <input type="text" id="verificationCode" name="verificationCode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
    
            <div class="mt-6">
              <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Verifica
              </button>
            </div>
          </form>
        </div>
      </div>
      
      <!-- Right side with styled image (optional, based on your design needs) -->
      <div class="hidden md:block md:w-1/2">
        <img src="loginPaginaFoto.svg" alt="Your Image Description" class="object-cover h-full w-full rounded-r-xl shadow-lg">
      </div>
      
    </div>
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
</body>
</html>