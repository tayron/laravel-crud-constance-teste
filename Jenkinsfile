node {
  stage 'Baixando Projeto'
  git url: 'https://github.com/tayron/constance-teste.git'

  stage 'Subindo container'
  sh "docker-compose -f docker-compose-buld.yml up --build -d"
  
  stage 'Baixando as dependências'  
  sh "docker exec constanceteste_php composer install"
  
  stage 'Atualizando tabelas do banco'
  sh "docker exec constanceteste_php php artisan migrate"

  stage 'Criando diretório deploy'
  sh "mkdir -p ./deploy"
  
  stage 'Copiando projeto para deploy'
  sh "docker cp constanceteste_php_1:/var/www/html/ ./deploy"
  
  stage 'Desligando containers Docker'
  sh "docker stop constanceteste_php"
  sh "docker stop constanceteste_mysql"
  
  stage 'Removendo arquivos que não devem ir pra produção'
  ssh “rm -rf ./deploy/html/build”
  ssh “rm -rf ./deploy/html/tests”
  ssh “rm -rf ./deploy/html/.git”
  ssh “rm -rf ./deploy/html/artisan”
  ssh “rm -rf ./deploy/html/composer.json”
  ssh “rm -rf ./deploy/html/composer.lock”
  ssh “rm -rf ./deploy/html/docker-compose.yml”
  ssh “rm -rf ./deploy/html/docker-compose-build.yml”
  ssh “rm -rf ./deploy/html/phpcs.phar”
  ssh “rm -rf ./deploy/html/package.json”
  ssh “rm -rf ./deploy/html/Jenkinsfile”
  ssh “rm -rf ./deploy/html/readme.md”
  ssh “rm -rf ./deploy/html/webpack.mix.js”
  ssh “rm -rf ./deploy/html/.env.example”
  ssh “rm -rf ./deploy/html/.gitattributes”
  ssh “rm -rf ./deploy/html/deploy.sh”
  ssh “rm -rf ./deploy/html/index.nginx-debian.html"
}
