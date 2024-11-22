<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuentas de LoL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            margin: 10px;
            width: 300px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            margin: 0;
        }

        .card p {
            margin: 5px 0;
            color: #555;
        }

        .price {
            font-size: 1.2em;
            font-weight: bold;
            color: #2a9d8f;
        }
    </style>
</head>

<body>
    <h1>Cuentas de League of Legends</h1>
    <div id="accounts-container"></div>

    <script>
        // Cargar las cuentas desde el backend
        async function loadAccounts() {
            const response = await fetch('get_accounts.php'); // Llama al endpoint PHP
            const accounts = await response.json(); // Convierte la respuesta JSON en un objeto JS

            const container = document.getElementById('accounts-container');
            container.innerHTML = ''; // Limpia el contenedor

            accounts.forEach(account => {
                const card = document.createElement('div');
                card.className = 'card';

                card.innerHTML = `
                    <h3>${account.juego} - Nivel ${account.nivel}</h3>
                    <p>Estado: ${account.estado}</p>
                    <p class="price">$${account.precio}</p>
                    <p>Creado el: ${new Date(account.fecha_creacion).toLocaleString()}</p>
                `;

                container.appendChild(card);
            });
        }

        // Llamar a la función al cargar la página
        loadAccounts();
    </script>
</body>

</html>