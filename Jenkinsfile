node {
  stage ('Baixando Projeto'){
    git url: 'https://github.com/tayron/constance-teste.git'
  }

  stage ('Subindo container'){
    sh "docker-compose -f docker-compose-buld.yml up --build -d"
  }
  
  stage ('Baixando as dependências'){
    sh "docker exec constanceteste_php composer install"
  }
  
  stage ('Atualizando tabelas do banco'){
    sh "docker exec constanceteste_php php artisan migrate"
  }

  stage ('Criando diretório deploy'){
    sh "mkdir -p ./deploy"
  }
  
  stage ('Copiando projeto para deploy'){
    sh "docker cp constanceteste_php_1:/var/www/html/ ./deploy"
  }
  
  stage ('Desligando containers Docker'){
    sh "docker stop constanceteste_php"
    sh "docker stop constanceteste_mysql"
  }
  
  stage ('deploy'){
    sh "lftp -e 'open ftp.site.com.br; user usuario senha; mirror -X .* -X .*/ --reverse --verbose --delete  ./deploy/html/ /public_html/; bye'"
    sh "rm -rf ./deploy"
  }
}
