<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('app/visao/head.php') ?>
    <title>Programacão para WEB 2021/2 - Login</title>
</head>
<body class="flex items-center justify-center">
    <a href="index.php?acao=listar" class="absolute right-0 top-0 text-white font-bold mt-6 mr-6 cursor-pointer leading-none">
        <div class="flex items-center">
            <ion-icon name="list-outline" class="text-2xl pr-1"></ion-icon>
            <div>Listar usuários</div>
        </div>
    </a>
    
    <form class="bg-white shadow-md rounded px-8 py-10 mb-4" method="POST">
        <?php require 'app/visao/alert.php' ?>
        <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
            Email
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="meu@email.com" value="<?= $_GET['email'] ?>" required>
        </div>
        <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            Senha
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" name="senha" type="password" placeholder="******************" pattern=".{4,}" required>
        </div>
        <div class="flex items-center justify-between">
        <button class="font-bold text-white bg-primary py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Entrar
        </button>
        <a class="inline-block align-baseline font-bold text-sm text-primary hover:text-blue-800" href="index.php?acao=cadastrar">
            Desejo me cadastrar.
        </a>
        </div>
    </form>
</body>
</html>