# Mudah Framework

Este README deve ser utilizado para consultas do projeto e instruções de instalação do mesmo.

# Iniciando

Este projeto foi desenvolvido como um teste para webjump, e foi feito de maneira que pudesse ter um desenvolvimento rápido e simples, porém, ao mesmo tempo robusto. Utiliza o padrão MVC, dentro da pasta App, onde poderemos encontrar as pastas Cache, Controller, Core, Model e View. Em cache temos um cache das páginas para que possam ser geradas mais rapidamente.

### Criando Controller
Em Controller temos todos os arquivos controladores deste projeto. Caso seja necessário adicionar algum é bem simples, bastando seguir o modelo abaixo:

```php
<?php

/*
 * This file is part of the leviframework to projetc webjump.
 *
 * (c) Levi Costa <levi.costa1@gmail.com>
 *
 * For non-commercial use
 * 
 */
 
 /*
  * Set PHP heavily typed
  */
declare(strict_types=1);
namespace App\Controller;

use Psr\Http\Message\ResponseInterface;

/**
 * Class Controller.
 *
 * @author Levi Costa <levi.costa1@gmail.com>
 */
class Controller extends Controller
{

	/**
     * @var ResponseInterface
     */
	private $response;

	public function __construct(ResponseInterface $response)
	{
		parent::__construct();
		$this->response = $response;
	}
}
```

Aqui definimos o PHP como fortemente tipado e também extendemos a classe Controller e definindo nosso namespace para App\Controller.


### Criando Model

Da mesma maneira criar um model é bem simples, basta seguir o modelo abaixo:
```php
<?php

/*
 * This file is part of the leviframework to projetc webjump.
 *
 * (c) Levi Costa <levi.costa1@gmail.com>
 *
 * For non-commercial use
 * 
 */

 
 /*
  * Set PHP heavily typed
  */
declare(strict_types=1);
namespace App\Model;

class Model extends Connection
{

	/**
     * @var string
     * @label('table name')
     */
	private static $table = 'table_name';
	
	public function __construct()
	{
		parent::__construct();
	}
}
```
Aqui definimos o PHP como fortemente tipado e também extendemos a classe Connection e definindo nosso namespace para App\Model. Para maiores instruções de utilização de comando de banco de dados consulte a documentação em [Faapz PDO](https://github.com/FaaPz/PDO)

### Adicionando Rotas
Para adicionar rotas basta no arquivo public/index.php adicionar o controlador as definições dentro da função addDefinitions() da seguinte forma:
```php
Controller::class => create(Controller::class)
        ->constructor(get('Response')),
        'Response' => function(){
          return new Response();
        }
```
Pode ser passado mais parâmetros no constructor, basta adiciona-los aqui.

E dentro da variável $routes na função simpleDispatcher() poderá adicionar as rotas como no exemplo abaixo:
```php
$route->get('/url', [Controller::class, 'function']);
$route->post('/url', [Controller::class, 'function']);
```

# Instalação
Este projeto pode ser inicializado usando servidor local do PHP com o seguinte comando

```sh
php -S localhost:8000 -t public
```
É importante que seja apontado para a pasta public. Também pode ser utilizado utilizando Vhosts apontando para a pasta public

### Requisitos

Para o projeto funcionar corretamente é importante ter o PHP versão >= 7.2.+ e o MySql. É importante dar pemissão de leitura e escrita na pasta /public/images/product.

### Mysql

É preciso definir o comando abaixo no MySql para que o sistema leia corretamente o arquivo .sql

```sql
SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
```

Importe o arquivo .sql que está na raiz do projeto para um banco de dados MySql.

### .env

Abra o arquivo .env na pasta raiz do projeto e altere as variáveis de ambiente com os dados do banco de dados que será utilizado.

### Composer

Este projeto utiliza o [composer](https://getcomposer.org/) para o gerenciamento de bibliotecas, por isso é importante ter o composer instalado. Após instalado rosa o comando

```sh
composer install
```

# Bibliotecas

As bibliotecas utilizadas para este projeto foram:

* [PHP-DI](http://php-di.org/)

Container de injeção para auxiliar envio injeções sem necessidade de um framework

* [Relay](https://relayphp.com/)

Biblioteca para manipulação de requisições

* [Zend-Diactoros](https://docs.zendframework.com/zend-diactoros/)

Implementações da PSR-7  com interfaces HTTP Mensagens

* [Fast-Route](https://docs.zendframework.com/zend-diactoros/)

Implementação de Rotas Rápidas

* [Fast-Route](https://github.com/middlewares/fast-route)

Implementação de Rotas Rápidas

* [Request-Handles](https://github.com/middlewares/request-handler)

Executa menipuladores descobertos pelas rotas

* [Http-emitter](https://github.com/narrowspark/http-emitter)

Implementação para emitir respostas ao servidor PHP

* [PHP Dotenv](https://github.com/vlucas/phpdotenv)

Implementação para leitura de váriaveis no arquivo .env

* [Laravel DD](https://github.com/larapack/dd)

Método de ajuda para debugar no projeto

* [Faapz PDO](https://github.com/FaaPz/PDO)

Auxilia na conexão PDO com banco de dados

* [Blade](https://github.com/jenssegers/blade)

Utilização de camada de visualização blade do laravel no projeto