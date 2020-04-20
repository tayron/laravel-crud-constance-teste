<?php

namespace Deployer;

require 'recipe/laravel.php';

env('branch','master');
set('deploy_path', '/home/deploy');
set('current_path', '/var/www/html');
set('composer_install_path', '/home/ubuntu/libs/composer.phar');

// Project name
set('application', 'laravelCrudConstanceTeste');

// Project repository
set('repository', 'https://github.com/tayron/laravel-crud-constance-teste.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', ['app/storage']);

// Writable dirs by web server 
add('writable_dirs', ['app/storage', 'app/storage/logs']);
set('allow_anonymous_stats', false);

// Hosts
/*
host('0.0.0.0')
    ->user('root')
    ->port(22)
    //->identityFile('pem-greensignal.pem')
    ->forwardAgent(true)
    ->multiplexing(true);
*/
// Tasks

/*Tarefas que não funcionam*/
task('deploy:writable', function(){});
task('artisan:migrate', function(){});
task('deploy:vendors', function(){});
task('deploy:assetic:dump', function(){});
task('deploy:cache:warmup', function(){});
/*Fim tarefas que não funcionam*/

task('laravel:storage_dir', function() {
    run("sudo chmod -R 777 {{deploy_path}}/shared/storage/");
});

task('laravel:vendor:install', function() {
    run("composer install --working-dir='/var/www/html'");
});

task('laravel:vendor:update', function() {
    run("composer update --working-dir='/var/www/html'");
});

task('laravel:database:migrate', function() {

    run("php /var/www/html/artisan migrate");
});

task('laravel:rename:env_file', function() {
    run("sudo mv {{current_path}}/.env.production  {{deploy_path}}/shared/.env");
});

task('build', function () {
    run('cd {{release_path}} && build');
});

task('deploy',
    [
        'deploy:prepare',
        'deploy:lock',
        'deploy:release',
        'deploy:update_code',
        'deploy:shared',
        'deploy:vendors',
        'deploy:writable',
        'deploy:symlink',
        'laravel:vendor:install',
        'laravel:database:migrate',
        'artisan:storage:link',
        'laravel:storage_dir',
        'laravel:rename:env_file',
        'cleanup',
        'deploy:unlock',
        'success'
    ]
);

task('release',
    [
        'deploy:prepare',
        'deploy:lock',
        'deploy:release',
        'deploy:update_code',
        'deploy:shared',
        'deploy:vendors',
        'deploy:writable',
        'deploy:symlink',
        'laravel:vendor:update',
        'laravel:database:migrate',
        'artisan:storage:link',
        'laravel:storage_dir',
        'cleanup',
        'deploy:unlock',
        'success'
    ]
);

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
// Migrate database before symlink new release.
//before('deploy:symlink', 'artisan:migrate');

