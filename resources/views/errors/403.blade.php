<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Negado</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Link para o seu CSS -->
    <style>
        body {
            background-color: #f8fafc; /* Cor de fundo padrão do Laravel */
            color: #333; /* Cor do texto padrão */
            font-family: 'Nunito', sans-serif; /* Fonte padrão do Laravel */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        .display-1 {
            font-size: 6rem; /* Tamanho da fonte para o código de status */
            font-weight: bold;
            color: #dc3545; /* Cor do texto para o erro */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="display-1">403</h1>
        <h2>Acesso Negado</h2>
        <p>Você não tem permissão para acessar esta página.</p>
    </div>
</body>
</html>
