<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('app/visao/head.php') ?>
    <title>Programacão para WEB 2021/2 - Meus dados</title>
</head>
<body class="flex items-center justify-center">
    <form class="bg-white shadow-md rounded px-8 py-10 mb-4" method="POST" action="?acao=sair">
        <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
            Nome
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" value="<?= $data->nome ?>" disabled>
        </div>
        <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
            Email
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" value="<?= $data->email ?>" disabled>
        </div>
        <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            Senha
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" value="<?= $data->senha ?>" disabled>
        </div>
        <div class="flex items-center justify-center">
        <button class="font-bold text-white bg-primary py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Sair
        </button>
        </div>
    </form>
</body>
</html>