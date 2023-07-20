<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="//unpkg.com/alpinejs" defer></script>
        <!-- SweetAlert2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#ef3b2d",
                        },
                    },
                },
            };
        </script>
        <style>
          body {
            font-family: 'Open Sans', sans-serif;
            background-color: #E6E4D8;
          }

          .menu-hover:hover {
            background-color: white;
            padding: 10px 15px;
            border-radius: 50px;
          }

          footer{
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            background-color: #E6E4D8;
            color: black;
            height: 2rem;
            margin-top: 6rem;
            opacity: 0.9;
            letter-spacing: 3px;
            font-size: 11px;
          }
            i {
              color: #888888;
              font-size: 70%;
            }

          .quantity-dec, .quantity-inc {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            color: white;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            display: inline-block;
          }

          .quantity-inc {
              background-color: #4f714f !important;
          }

          .quantity-dec {
              background-color: #8c3b3b !important;
          }

          #popupOverlay {
              display: none;
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              background-color: rgba(0, 0, 0, 0.5);
              z-index: 999;
          }

          .popupBox {
              position: fixed;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              background-color: white;
              padding: 20px;
              border-radius: 5px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
          }

          .popupBox h2 {
              margin-top: 0;
              font-weight: bold;
          }

          .popupBox input[type="text"] {
              padding: 10px;
              margin-bottom: 10px;
              width: 100%;
              box-sizing: border-box;
          }

          .popupBox button {
              padding: 10px 20px;
              margin-right: 10px;
              background-color: #506050;
              color: white;
              border: none;
              border-radius: 5px;
              cursor: pointer;
          }

          .popupBox button#closePopup {
              background-color: #b24a4a;
          }
                    
        </style>
        <!-- navigation header -->
        <title>Homebaker Inventory Management System</title>
    </head>
    <body class="mb-48">
        <nav class="flex justify-between items-center mb-4">
            <a href="/">
              <img class="w-24" style="width: 50%; height: auto; margin-left: 20px; margin-top: 10px;" src="images/logo.png" alt="" class="logo" />
            </a>
            <ul class="flex space-x-6 mr-6 text-lg" style="letter-spacing:3px;">
              @auth
              <li>
                <a href="/menu" class="menu-hover"> Menu </a>
              </li>
              <li>
                  <a href="/inventory" class="menu-hover"> Inventory </a>
              </li>
              <li>
                <a href="/order" class="menu-hover"> Order </a>
              </li>
              <li>
                <form class="inline" method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="menu-hover"> Logout </button>  
                </form>         
              @else
              <li>
                <a href="/menu" class="menu-hover"> Menu </a>
              </li>
              <li>
                  <a href="/register" class="menu-hover"> Register </a>
              </li>
              <li>
                  <a href="/login" class="menu-hover"> Login </a>
              </li>
              @endauth
            </ul>
        </nav>
        <main>
          {{ $slot }}
        </main>
      <footer>
        <p class="ml-2">All Rights Reserved © 2023 CLOVERHOMEBAKER SDN. BHD. (1396448-U)</p>
      </footer>
      <x-flash-message />
    </body>
</html>
