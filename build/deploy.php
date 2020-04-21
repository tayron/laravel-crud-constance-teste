<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'my_project');
set('http_user', 'root');
set('writable_mode', 'chmod');


// Project repository
set('repository', 'https://github.com/tayron/laravel-crud-constance-teste.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false); 

// Shared files/dirs between deploys 
#add('shared_files', ['.env']);
#add('shared_dirs', ['storage']);

// Writable dirs by web server 
#add('writable_dirs', ['storage']);
set('allow_anonymous_stats', false);

// Path to deploy
set('deploy_path', '/var/www/html');    
    
// Tasks
task('build', function () {
   run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');
