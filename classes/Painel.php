<?php

class Painel {


    public static function generateSlug($str){
        $slug = mb_strtolower($str);
        $slug = preg_replace('/(â|á|â)/','a',$slug);
        $slug = preg_replace('/(ê|é)/','e',$slug);
        $slug = preg_replace('/(í)/','i',$slug);
        $slug = preg_replace('/(ó|ô)/','o',$slug);
        $slug = preg_replace('/(ú)/','u',$slug);
        $slug = preg_replace('/(?|\/|!|#)/','',$slug);
        $slug = preg_replace('/( )/','-', $slug);
        $slug = strtolower($slug);

        return $slug;
    }

    public static function pegaCargo($n){
        $cargo = [
            '1' => 'Gerente',
            '2' => 'Sub-administrador',
            '3' => 'Administrador'
        ];

        return $cargo[$n];
    }

    public static function alert($operacao, $mensagem){
        echo "<div class='mensagem " . $operacao . "> " . $mensagem . "</div>";
   }

   public static function isLogin(){
        if(isset($_SESSION['logado'])){
            return true;
        } else {
            return false;
        }
    }

   public static function logout(){
    session_destroy();
    header('Location'.PAINEL);
    }

    public static function carregarPagina(){
        if(isset($_GET['url'])){
            $cliente = explode('/', $_GET['url']);
            if($cliente[0] == 'cliente'){
                include('pages/' . $cliente[0] . '.php');
                die();
            }
            if(file_exists('pages/'.$_GET['url'] . '.php')){
                include('pages/'.$_GET['url'] . '.php');
            } else {
                //página não existe
                include('pages/home.php');
            }
        } else {
            include('pages/home.php');
        }
        
    }

    public static function login($post){
        @$login = $post['login'];
        @$pass = md5($post['pass']);

        $sql = \Mysql::conectar()->prepare("SELECT * FROM `users` WHERE `logi` = ? AND `senha` = ?");
        $sql->execute(array($login,$pass));
        $creds = $sql->fetch();

        if($creds){
            $_SESSION['logado'] = true;
            $_SESSION['user'] = $creds['logi'];
        }
    }

    public static function upload_img($file,$dir){
        if($file['name'] != ''){
            if($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png'){
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newName = substr($file['name'],0,-5) . uniqid() . '.' . $extension;
                move_uploaded_file($file['tmp_name'], $dir . $newName);
                return $newName;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function salva_visita(){
        if(isset($_COOKIE['visita'])){
            $token = $_COOKIE['visita'];
            $data = date('Y-m-d');
        } else {
            setcookie('visita',uniqid(),time() + (60*60*24*30));
            $token = $_COOKIE['visita'];
            $data = date('Y-m-d');
        }
        $sql = \Mysql::conectar()->prepare("INSERT INTO `visitas` VALUES (null,?,?)");
        $sql->execute(array($token,$data));
    } 

    public static function limpa_visitas(){
        $sql = \Mysql::conectar()->prepare("DELETE FROM  visitas WHERE dia < DATE_SUB(NOW(), INTERVAL 1 MONTH)");
        $sql->execute();
    } 

    public static function visitas_dia(){
        $dia = date('Y-m-d');
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `visitas` WHERE `dia` = ?");
        $sql->execute(array($dia));
        return $sql->rowCount();
    }

    public static function visitas_mes(){
        $sql = \Mysql::conectar()->prepare("SELECT * FROM `visitas`");
        $sql->execute();
        return $sql->rowCount();
    }

}



?>