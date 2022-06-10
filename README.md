# Framework-oop-PHP
Mini Framework orientado a objetos em PHP

#Documentação

**************

Painel::generateSlug($str) 

função feita para armazenar slug em banco de dados, 
exemplo:

$url = 'Notícia 123';

$slug = Painel::generateSlug($url);

echo $slug;
//output 
// noticia-123

***************

Painel::alert($classe, $mensagem);

cria div com a classe especificada e mensagem,
usada para retornar status de post

****************

Painel::isLogin();

verifica se usuario está logado,
não é nessessário uso de parâmetros, 
a função busca sessão de login, retorna true ou false;

******************

Painel::logout();

faz o logou do sistema, 

**************

Painel::carregarPagina();

usado com URLs amigáveis, busca página indicada na url dentro do diretório 'pages/',
se a página não existe redireciona para home

**************

Painel::login($post)

faz login com usuario e senha, array passado como parâmetro,
em caso de sucesso retorna sessão ['login'] = true e ['user'] = usuario

**************

Painel::upload_img($file,$dir)

faz upload de imagens, primeiro parâmetro é o array do arquivo, segundo parâmetro
o diretorio em que a imagem será salva, em caso de sucesso, retorna o nome da imagem,
em caso de erro retorna false

**************

Painel::salva_visita()

cria cookie e armazena do banco de dados a visita, salvando apenas o dia e o token do cookie, 
usado para saber sobre visitas ná página

**************
Painel::limpa_visitas()

exclui do banco de dados visitas á mais de 1 mês

**************

Painel::visitas_dia()

conta visitas do dia;

**************

Painel::visitas_mes()

conta visítas no mês;

**************

Mysql::conectar()

cria conexão com banco de dados, usando constantes definidas em config.php

**************
