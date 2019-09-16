node {
  stage 'Checkout'
  git url: 'https://github.com/tayron/constance-teste.git'

  stage 'build'
  sh "docker kill constanceteste_php_1 crud_mysql_1 > /dev/null 2>&1"
  sh "docker rm constanceteste_php_1 crud_mysql_1 > /dev/null 2>&1"
  sh "docker-compose -f docker-compose-buld.yml up --build -d"

  stage 'dependence'
  sh "docker exec -t constanceteste_php_1 composer install"
  
  stage 'migrate'
  sh "docker exec -t constanceteste_php_1 php artisan migrate"
}
