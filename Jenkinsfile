node {
  stage 'Checkout'
  git url: 'https://github.com/tayron/constance-teste.git'

  stage 'build'
  sh "docker-compose -f docker-compose-buld.yml up --build -d"

  stage 'deploy'
  sh './deploy.sh'
}
