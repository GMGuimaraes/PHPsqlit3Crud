<?php 

require 'Controlador.php';
require 'app/modelos/Usuario.php';

/**
* Controlador do login.
*/
class LoginController extends Controller  {
    
    /**
    * @var Usuario armazena o usuário logado no momento.
    */
    private $loggedUser;
    
    /**
    *  Construtor da classe. 
    *  Inicia/recupera a sessão do usuário e recupera o usuário logado.
    */
    function __construct() {
        session_start();
        if (isset($_SESSION['user'])) $this->loggedUser = $_SESSION['user'];
    }
    
    /**
    *  Método que trata as requisições:
    *  POST - busca pelo email no banco e confere se a senha é igual. Se sim, usuário logado!
    *  GET  - se não logado, abre a página de login, senão mostra as informações do usuário
    */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = Usuario::buscar($_POST['email']);

            if (!is_null($usuario) && $usuario->igual($_POST['email'], $_POST['senha'])) {
                $_SESSION['user'] = $this->loggedUser = $usuario;
            }
            

            if ($this->loggedUser) {
                header('Location: index.php?acao=info');
            } else {
                header('Location: index.php?email=' . $_POST['email'] . '&mensagem=Usuário e/ou senha incorreta!');
            }
        } else {
            if (!$this->loggedUser) {
                $this->view('users/login');
            } else {
                header('Location: index.php?acao=info');
            }
        }
    }

    /**
    *  Método que trata as requisições:
    *  POST - cadastra o usuário com os dados informados. Se cadastrado, informa a indisponibilidade.
    *  GET  - mostra a página de cadastro.
    */
    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new Usuario($_POST['email'], $_POST['senha'], $_POST['nome']);
            
            try {
                $user->salvar();
                header('Location: index.php?email=' . $_POST['email'] . '&mensagem=Usuário cadastrado com sucesso!');
            } catch(PDOException $erro) {
                header('Location: index.php?acao=cadastrar&mensagem=Email já cadastrado!');
            }
        }
        $this->view('users/cadastrar');
    }

    /**
    *  Método que trata as requisições:
    *  POST - deleta um usuário dado um "id" passado pelo corpo da requisição.
    *
    *  ============  EXERCÍCIO AVALIATIVO  ============
    *
    *  Nesta atividade avaliativa você deverá implementar a lógica para deletar um
    *  usuário cadastrado no banco de dados. Essencialmente, devendo-se manter
    *  a arquitetura da aplicação nos moldes como foi definida.
    *
    *  Assim, você pode seguir os seguintes passos para resolver essa atividade:
    *
    *  Passo 1: Buscar pelo usuário o qual deseja-se remover do banco de dados.
    *           O email a ser deletado é passado no corpo da requisição POST.
    *           Além disso, a classe Usuário já possui um método de busca implementado.
    *
    *  Passo 2: Criar um método, não estático, em Usuário com nome 'deletar'
    *           que ao ser invocado, executa o commando delete no banco de dados
    *           usando como filtro o email da própria instrução. O método salvar
    *           da própria classe pode servir como inspiração.
    *
    *  O trecho de código abaixo está preenchido com base nas sugestões acima.
    *  Mas poderá ser modificado se achar necessário.
    *
    */
    public function deletar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["email"]) {
            $user = Usuario::buscar($_POST["email"]);

            try {
                $user->deletar(); // TODO - Nome de método sugerido e já definido em Usuário
                header('Location: index.php?mensagem=Usuário deletado com sucesso!');
            } catch(PDOException $erro) {
                header('Location: index.php?acao=listar&mensagem=Erro ao deletar ' . $_GET["email"] . ' !');
            }
        } else {
            header('Location: index.php?acao=listar&mensagem=É necessário informar o email!');
        }
    }

    /**
    *  Se o usuário estiver logado, motra as informações do mesmo.
    *  Senão, redireciona para a página de login.
    */
    public function info() {
        if (!$this->loggedUser) {
            header('Location: index.php?acao=entrar&mensagem=Você precisa se identificar primeiro');    
            return;
        }
        $this->view('users/info', $this->loggedUser);        
    }

    /**
    *  Se o usuário estiver logado, destroi a sessão e redireciona para a página de login.
    *  Senão, redireciona para a página de login.
    */
    public function sair() {
        if (!$this->loggedUser) {
            header('Location: index.php?acao=entrar&mensagem=Você precisa se identificar primeiro');
            return;
        }
        session_destroy();
        header('Location: index.php?mensagem=Usuário deslogado com sucesso!');
    }


    /**
     *  Método que lista todos os usuários cadastrados no sistema 
     */
    public function listar() {
        $this->view('users/listar', Usuario::buscarTodos());   
    }
}

?>