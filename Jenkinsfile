node {
  stage 'Checkout'
  git url: 'https://github.com/tayron/constance-teste.git'

  stage 'build'
  sh "docker-compose -f docker-compose-buld.yml up --build -d"

  stage 'dependence'
  sh "docker exec -t constanceteste_php_1 composer install"
  
  stage 'migrate'
  sh "docker exec -t constanceteste_php_1 php artisan migrate"
}
