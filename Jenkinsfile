node {
  stage 'Checkout'
  git url: 'https://github.com/tayron/constance-teste.git'

  stage 'build'
  docker.build('constanceteste_php_1')

  stage 'deploy'
  sh './deploy.sh'
}
