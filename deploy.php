<?php
namespace Deployer;

require 'recipe/symfony.php';

// Configuration
set('ssh_type', 'native');
set('ssh_multiplexing', true);
set('repository', 'https://github.com/hkbrain/projectDemo.git');
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
set('shared_dirs', ['var/logs', 'var/sessions']);
// Symfony writable dirs
set('writable_dirs', ['var/cache', 'var/logs', 'var/sessions']);
// Symfony executable and variable directories
set('bin_dir', 'bin');
set('var_dir', 'var');


// Hosts
server('prod','localhost')
    ->stage('production')
->user('deployer')
        ->identityFile('~/.ssh/id_rsa.pub', '~/.ssh/id_rsa', null)
    ->set('deploy_path', '/home/deployer/html/jk_deply/projectDemo-Prod');

server('stag','localhost')
    ->stage('stag')
    ->user('deployer')
        ->identityFile('~/.ssh/id_rsa.pub', '~/.ssh/id_rsa', null)
    ->set('deploy_path', '/home/deployer/html/jk_deply/projectDemo-Stag');

server('dev','localhost')
    ->stage('demo')
    ->user('deployer')
        ->identityFile('~/.ssh/id_rsa.pub', '~/.ssh/id_rsa', null)
    ->set('deploy_path', '/home/deployer/html/jk_deply/projectDemo-Dev');


// Tasks

task('tests:unit', function () {
    run('cd {{release_path}} && phpunit --testsuite Unit');
})->desc('Run Unit Tests');


// [Optional] if deploy fails automatically unlock.

after('database:migrate', 'tests:unit');

after('deploy:failed', 'deploy:unlock');

after('deploy:failed', 'cleanup');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');
