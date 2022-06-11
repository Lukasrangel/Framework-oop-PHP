<?php

$autoload = function($class){
    include('classes/' . $class . '.php');
};

spl_autoload_register($autoload);


//diretorio inicial da aplicação
define('INITIAL_PATH', 'http://127.0.0.1/framework_opp');


//constantes de conexão
define('DB','inkonstante');
define('HOST','127.0.0.1');
define('USER','root');
define('PASS','');


?>