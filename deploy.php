<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'git@github.com:michielgerritsen/TALL-Magento.git');

set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader --no-suggest');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

inventory('hosts.yml');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

desc('Copy assets data');
task('assets:upload', function () {
    runLocally('npm run production');
    writeln('Compiled assets');

    upload('public/js/', '{{release_path}}/public/js/');
    writeln('Uploaded public/js/');

    upload('public/css/', '{{release_path}}/public/css/');
    writeln('Uploaded public/css/');

//    upload('public/fonts/', '{{release_path}}/public/fonts/');
//    writeln('Uploaded public/fonts/');

//    upload('public/images/', '{{release_path}}/public/images/');
//    writeln('Uploaded public/images/');

//    upload('public/vendor/', '{{release_path}}/public/vendor/');
//    writeln('Uploaded public/vendor/');
});

after('deploy:writable', 'assets:upload');

desc('Restart php-fpm');
task('php-fpm:restart', function () {
    run('sudo service php7.4-fpm reload');
});

after('deploy:symlink', 'php-fpm:restart');

desc('Flush Laravel cache');
task('artisan:cache:clear', function () {
    run('cd {{release_path}} && {{bin/php}} artisan cache:clear');
});

after('deploy:symlink', 'artisan:cache:clear');

