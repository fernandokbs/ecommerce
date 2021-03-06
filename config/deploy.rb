# config valid for current version and patch releases of Capistrano
lock "~> 3.14.1"

set :application, "Laravel_capistrano"
set :repo_url, "git@github.com:fernandokbs/ecommerce.git"

set :branch, "Laravel-8"
set :deploy_to, '/var/www/laravel-capistrano'
set :laravel_dotenv_file, '/var/www/secrets/.env'
set :keep_releases, 5

namespace :composer do
    desc "Running Composer Install"
    task :install do
        on roles(:composer) do
            within release_path do
                execute :composer, "install --no-dev --quiet --prefer-dist --optimize-autoloader"
            end
        end
    end
end
namespace :laravel do
    task :fix_permission do
        on roles(:laravel) do
            execute :sudo, "chown -R $USER:www-data #{release_path}/storage/ #{release_path}/bootstrap/cache/"
            execute :sudo, "chmod -R 775 #{release_path}/storage/ #{release_path}/bootstrap/cache/"
        end
    end
    task :configure_dot_env do
    dotenv_file = fetch(:laravel_dotenv_file)
        on roles (:laravel) do
        execute :cp, "#{dotenv_file} #{release_path}/.env"
        end
    end
end

namespace :deploy do
    after :updated, "composer:install"
    after :updated, "laravel:fix_permission"
    after :updated, "laravel:configure_dot_env"
end