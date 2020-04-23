# O Teste

Deverá ser criado um sistema simples, totalmente desenvolvido em PHP, onde será possível Criar/Editar/Excluir/Listar usuários. O sistema também deve possuir a possibilidade de associar um perfil (role) ao usuário.

Seguem os atributos para cada entidade:

## - USUÁRIO:
1. Nome;
2. E-mail;
3. Telefone;
4. Data de Nascimento;
5. Cargo;
6. Salário;
7. Foto.

## - PERFIL:
1. Nome do perfil
2. Descrição

A foto será um upload na parte de cadastro de usuário, que aparecerá na tela de cadastro/edição, e na listagem a foto deverá ser  exibida;

## Premissas
1. Dever ter alguma alguma dependência via composer;
2. Passar no php code sniffer com PSR-2: Coding Style Guide;
3. Teste unitário de pelo menos 3 funções;
4. Deploy em um repositório do github ou do bitbucket.

## Flexibilidade
Você poderá utilizar qualquer framework para desenvolver o projeto, lembrando que a arquitetura utilizada, você deverá defendê-la pessoalmente na nossa entrevista (caso passe no teste).

## Prazo
O deadline será até  25/06 (terça-feira), e qualquer dúvida pode enviada respondendo este email.


## Configuração do projeto para execução

### DOCKER
O projeto utiliza Docker e Docker Compose para criação do ambiente de desenvolvimento, caso não tenha instalado, segue o link para instalação:
1. https://docs.docker.com/v17.12/install/
2. https://docs.docker.com/compose/install/

### Build e execução dos containers Docker
Observação: A configuração do docker-compose.yml foi configurado para ser executado 
em uma máquina linux, caso use Windows, talvez tenha que fazer alguns ajustes.

```docker-compose up --build -d```

### Para ver os containers rodando
```docker ps```

```
CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS                               NAMES
28d6118b1b6a        crud_php            "docker-php-entrypoi…"   39 hours ago        Up 15 minutes       0.0.0.0:80->80/tcp, 9000/tcp        constanceteste_php_1
```

### Startar um servidor MySQL de sua preferencia e configurar os dados de conexão no arquivo .env
```
DB_CONNECTION=mysql
DB_HOST=servidor_mysql
DB_PORT=3306
DB_DATABASE=projeto
DB_USERNAME=root
DB_PASSWORD=yakTLS&70c52
```

### Acessar container PHP para configuração do projeto
```docker exec -it constanceteste_php_1 bash```

### Acessar container e executar o comando abaixo para fazer o deploy do projeto
```cd /home/projeto && dep deploy && cp .env /var/www/html/shared/storage/.env && chmod 777 -R /var/www/html/shared/storage/```

A saída do comando acima será algo semelhante:

```
✈︎ Deploying master on localhost
✔ Executing task deploy:prepare
✔ Executing task deploy:lock
✔ Executing task deploy:release
✔ Executing task deploy:update_code
✔ Executing task deploy:shared
✔ Executing task deploy:vendors
✔ Executing task deploy:writable
✔ Executing task artisan:storage:link
✔ Executing task artisan:view:cache
✔ Executing task artisan:config:cache
✔ Executing task artisan:optimize
✔ Executing task artisan:migrate
✔ Executing task deploy:symlink
✔ Executing task deploy:unlock
✔ Executing task cleanup
Successfully deployed!

```
### Acessar projeto pelo Browser, exemplo
```http://projeto.local```

### Premissas atendidas

#### 1) Dever ter alguma alguma dependência via composer;

Foi atendida usando a biblioteca: http://image.intervention.io/getting_started/installation ("intervention/image": "2.4")

#### 2) Passar no php code sniffer com PSR-2: Coding Style Guide;

Para validar se os controllers e a Trait estão dentro dentro das definições da psr2,
deve-se executar os seguintes comandos: 

1. ```php ~/phpcs.phar --standard=PSR2 app/Http/Controllers/ProfileController.php```
2. ```php ~/phpcs.phar --standard=PSR2 app/Http/Controllers/UserController.php```
3. ```php ~/phpcs.phar --standard=PSR2 app/Http/Traits/PhotoManipulation.php```
4. ```php ~/phpcs.phar --standard=PSR2 app/Http/Requests/Profiles/StoreRequest.php```
5. ```php ~/phpcs.phar --standard=PSR2 app/Http/Requests/Profiles/UpdateRequest.php```
6. ```php ~/phpcs.phar --standard=PSR2 app/Http/Requests/Users/StoreRequest.php```
7. ```php ~/phpcs.phar --standard=PSR2 app/Http/Requests/Users/UpdateRequest.php```
8. ```php ~/phpcs.phar --standard=PSR2 app/Models/ApplicationModel.php```
9. ```php ~/phpcs.phar --standard=PSR2 app/Models/Profile.php```
10. ```php ~/phpcs.phar --standard=PSR2 app/Models/User.php```


A saída dos comandos acima deverá ser:
```
root@28d6118b1b6a:/var/www/html# php phpcs.phar --standard=PSR2 app/Http/Controllers/ProfileController.php
root@28d6118b1b6a:/var/www/html# php phpcs.phar --standard=PSR2 app/Http/Controllers/UserController.php
root@28d6118b1b6a:/var/www/html# php phpcs.phar --standard=PSR2 app/Http/Traits/PhotoManipulation.php
root@0ae994dfca31:/var/www/html# php phpcs.phar --standard=PSR2 app/Http/Requests/Profiles/StoreRequest.php
root@0ae994dfca31:/var/www/html# php phpcs.phar --standard=PSR2 app/Http/Requests/Profiles/UpdateRequest.php
root@0ae994dfca31:/var/www/html# php phpcs.phar --standard=PSR2 app/Http/Requests/Users/StoreRequest.php
root@0ae994dfca31:/var/www/html# php phpcs.phar --standard=PSR2 app/Http/Requests/Users/UpdateRequest.php
root@0ae994dfca31:/var/www/html# php phpcs.phar --standard=PSR2 app/Models/ApplicationModel.php
root@0ae994dfca31:/var/www/html# php phpcs.phar --standard=PSR2 app/Models/Profile.php
root@0ae994dfca31:/var/www/html# php phpcs.phar --standard=PSR2 app/Models/User.php
```

#### 3) Teste unitário de pelo menos 3 funções;

Foi atendido implementado a classe de teste que se encontra em tests/Unit/PhotoManipulationTest.php.
Para executar o teste, execute o comando ```./vendor/bin/phpunit``` dentro do container PHP

A saída do comando acima deverá ser:

```
root@28d6118b1b6a:/var/www/html# ./vendor/bin/phpunit
PHPUnit 6.5.14 by Sebastian Bergmann and contributors.

........                                                            8 / 8 (100%)

Time: 530 ms, Memory: 16.00MB

OK (8 tests, 8 assertions)
```


#### 4) Deploy em um repositório do github ou do bitbucket;

Foi atendido com código versionado no GitHub: https://github.com/tayron/constance-teste
