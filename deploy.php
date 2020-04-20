<?php

namespace Deployer;

require 'recipe/laravel.php';

env('branch','master');
set('deploy_path', '/home/deploy');

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
task('deploy:assetic:dump', function(){});
task('deploy:cache:warmup', function(){});
task('laravel:vendors', function(){});
/*Fim tarefas que não funcionam*/

task('laravel:storage_dir', function() {
    run("chmod -R 777 {{deploy_path}}/shared/storage/");
});

task('laravel:vendor:install', function() {
    run("composer install --working-dir='{{release_path}}'");
});

task('laravel:vendor:update', function() {
    run("composer update --working-dir='{{release_path}}'");
});

task('laravel:database:migrate', function() {
    run("cd {{release_path}} && php artisan migrate");
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
        'laravel:vendors',
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

