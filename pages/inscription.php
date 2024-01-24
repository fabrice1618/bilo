<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../assets/output.css">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <title>Formulaire d'Inscription</title>
   </head>
   <body class="h-screen w-full text-white" style="background: url(../assets/free.jpg); background-size: cover;">
      <!-- Formulaire -->
      <div class="flex items-center justify-center h-4/5">
         <form class="w-1/5 border-2 border-white border-opacity-20 shadow-md backdrop-blur-20 flex items-center flex-col rounded-xl p-8 " action="../../backend/traitement_inscrip.php" method="post">
            <h1 class="text-3xl font-bold p-10">Inscription</h1>
            <div class="border-2 border-white border-opacity-20 shadow-md rounded-3xl p-2 w-4/5	 mb-5">
               <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" required class="bg-transparent placeholder:text-white">
               <i class='bx bxs-user ml-5'></i>
            </div>
            <div class="border-2 border-white border-opacity-20 shadow-md rounded-3xl p-2 w-4/5	 mb-5">
               <input type="password" id="motdepasse" name="motdepasse" placeholder="Password" required class="bg-transparent placeholder:text-white">
               <i class='bx bxs-lock ml-5'></i>
            </div>
            <div class="border-2 border-white border-opacity-20 shadow-md rounded-3xl p-2 w-4/5	 mb-5 ">
               <input type="password" id="confirm_motdepasse" name="confirm_motdepasse" placeholder="Confirm password" required class="bg-transparent placeholder:text-white 2  ">
               <i class='bx bxs-lock-alt ml-5'></i>
            </div>
            <input class="border-2 rounded-3xl p-2 w-4/5 bg-white text-black font-medium mb-5" type="submit" value="Submit">
            <div>
               <p>Tu a un compte? <a class="font-bold hover:underline" href="connexion.php">Connexion</a>
               </p>
            </div>
         </form>
      </div>
   </body>
</html>