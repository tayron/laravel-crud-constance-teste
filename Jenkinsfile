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
    sh "FTP_ADDRESS=''"
    sh "FTP_REMOTE_PATH='/public_html/jenkins'"
    sh "FTP_USER=''"
    sh "FTP_PASSWORD=''"
    sh "LOCAL_PATH='./deploy/html'"
    sh "export COMPOSER_MIRROR_PATH_REPOS=1"
    sh "lftp -c 'open -u $FTP_USER,$FTP_PASSWORD $FTP_ADDRESS; set ssl:verify-certificate no; mirror -Rnev $LOCAL_PATH $FTP_REMOTE_PATH'"
    sh "rm -rf ./deploy"
  }
}
