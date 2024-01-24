<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../assets/output.css">
      <link rel="shortcut icon" href="../assets/bilo.ico" type="image/x-icon">
      <title> LEADERBOARD </title>
   </head>
   <body class="h-screen w-full text-white" style="background: url(../assets/free.jpg); background-size: cover;"> <?php
            include '../components/navbar.php'
       ?> <style>
         #bienvenue {
            text-align: center;
            font-size: 35px;
            margin-top: 50px;
            margin-bottom: -40px
         }

         #incrementButton {
            padding: 10px 40px;
            border-radius: 10px;
            font-family: 'Pacifico', cursive;
            font-size: 25px;
            color: #ffffff;
            text-decoration: none;
            background-color: #3498DB;
            border-bottom: 5px solid #2980B9;
            text-shadow: 0px -2px #2980B9;
            transition: all 0.1s;
            -webkit-transition: all 0.1s;
         }

         #incrementButton:active {
            transform: translate(0px, 5px);
            -webkit-transform: translate(0px, 5px);
            border-bottom: 1px solid;
         }

         #incrementButton:hover {
            background-color: #0056b3;
            /* Couleur de fond au survol */
         }
      </style> <?php
                session_start();
                if (isset($_SESSION["pseudo"])) {
                    echo "
						<p id='bienvenue'>Bienvenue " . $_SESSION["pseudo"] . " !</p>";
                } else {
                    echo "
						<p id ='bienvenue'>Vous n'êtes pas connecté.</p>";
                }
            ?>
      <!-- LeaderBoard -->
      <div class="flex flex-col items-center justify-center h-4/5 ">
         <h1 class="text-3xl font-bold mb-4">LEADERBOARD</h1>
         <div class="mb-8 border rounded-xl">
            <table class="w-full border-collapse">
               <thead>
                  <tr>
                     <th class="py-2 px-4 border-b border-gray-300 text-center border-r	">Utilisateur</th>
                     <th class="py-2 px-4  border-b border-gray-300 text-center">Nombre de clics</th>
                  </tr>
               </thead>
               <tbody class="text-center" id="table-data">
                  <!-- Les données du tableau sont ajoutées ici  -->
               </tbody>
            </table>
         </div>
         <div class="mb-8">
            <button id="incrementButton" class="py-2 px-6 rounded-lg font-pacifico text-2xl text-white bg-blue-500 border-b-2 border-blue-900 shadow-md transition-transform hover:bg-blue-900 hover:translate-y-1 active:border-b-0 active:translate-y-5">Click</button>
         </div>
      </div>
      <script>
         // Fonction pour charger les données depuis le fichier PHP
         function chargerTable() {
            fetch("../../backend/show_dashboard.php").then(response => response.json()).then(data => {
               const table = document.getElementById('table-data');
               table.innerHTML = ''; // Effacer le contenu précédent de la table
               data.forEach(row => {
                  const tr = document.createElement('tr');
                  tr.innerHTML = `
							<td>${row.user_pseudo}</td>
							<td>${row.nbr_click}</td>`;
                  table.appendChild(tr);
               });
            }).catch(error => console.error(error));
         }
         // Appeler la fonction pour charger les données lors du chargement de la page
         window.onload = chargerTable;
         // Ajouter un intervalle de rafraîchissement automatique (par exemple, toutes les 5 secondes)
         setInterval(chargerTable, 10); // 5000 millisecondes = 5 secondes
         // Fonction pour charger les données depuis le fichier PHP
         function chargerTable() {
            fetch("../../backend/show_dashboard.php").then(response => response.json()).then(data => {
               const table = document.getElementById('table-data');
               table.innerHTML = ''; // Effacer le contenu précédent de la table
               data.forEach(row => {
                  const tr = document.createElement('tr');
                  tr.innerHTML = `
							<td>${row.user_pseudo}</td>
							<td class="border-l pl-4">${row.nbr_click}</td>`;
                  table.appendChild(tr);
               });
            }).catch(error => console.error(error));
         }
      </script>
      <script>
         // Ajoutez un gestionnaire d'événement pour le bouton
         document.getElementById("incrementButton").addEventListener("click", function() {
            // Utilisez une requête AJAX pour appeler le script PHP qui incrémente nbr_click
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../../backend/click.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
               if (xhr.readyState === 4 && xhr.status === 200) {
                  // Affichez la réponse si nécessaire
                  console.log(xhr.responseText);
               }
            };
            xhr.send();
         });
      </script>
   </body>
</html>