<?php

include_once("Banco.php");

/**
*  Classe que representa os dados de um usuário do sistema
*/
class Usuario {

    /**
    * @var string Email do usuário. 
    */
    private $email;

    /**
    * @var string Senha do usuário.
    */
    private $senha;

    /**
    * @var string Nome completo do usuário
    */
    private $nome;

    /**
    *  Construtor da classe que depende do email, senha e do nome.
    */
    function __construct(string $email, string $senha, string $nome) {
        $this->email = $email;
        $this->senha = hash('sha256', $senha);
        $this->nome = $nome;
    }

    /**
    *  Método mágico para acessar todos os campos
    */
    public function __get($campo) {
        return $this->$campo;
    }

    /**
    *  Método mágico para modificar todos os campos
    */
    public function __set($campo, $valor) {
        return $this->$campo = $valor;
    }

    /**
    *   Método que verifica se o email e senha providos são iguais ao da instância.
    *   Sua importância é devido ao fato da senha ser codificada.
    *
    *   @return bool Retorna TRUE se igual, senão FALSE
    */
    public function igual(string $email, string $senha) {
        return $this->email === $email && $this->senha === hash('sha256', $senha);
    }

    /**
     *  Função que salva os dados de um usuário no banco.
     *  Esta função não sobrescreve dados.
     */
    public function salvar() {
        $db = Banco::getInstance();
        $stmt = $db->prepare('INSERT INTO Usuarios (email, senha, nome) VALUES (:email, :senha, :nome)');
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this->senha);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->execute();
    }

    /**
     *  Função que deleta um usuário no banco.
     */
    public function deletar() {
        $db = Banco::getInstance();
	$stmt = $db->prepare("DELETE FROM Usuarios WHERE email = :email");
	$stmt->bindValue(':email', $this->email);
	$stmt->execute();
    }

    
    public static function buscar(string $email) {
        $db = Banco::getInstance();

        $stmt = $db->prepare('SELECT * FROM Usuarios WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado) {
            $usuario = new Usuario($resultado['email'], $resultado['senha'], $resultado['nome']);
            $usuario->senha = $resultado['senha'];
            return $usuario;
        } else {
            return NULL;
        }
    }


    public static function buscarTodos() {
        $db = Banco::getInstance();

        $stmt = $db->prepare('SELECT * FROM Usuarios');
        $stmt->execute();

        $resultado = $stmt->fetchAll();

        if ($resultado) {
            $usuarios = array();
            foreach ($resultado as $value) {
                $usuario = new Usuario($value['email'], $value['senha'], $value['nome']);
                $usuario->senha = $value['senha'];
                array_push($usuarios, $usuario);
            }
            return $usuarios;
        } else {
            return NULL;
        }
    }
}

?>