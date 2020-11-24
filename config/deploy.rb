# config valid for current version and patch releases of Capistrano
lock "~> 3.14.1"

set :application, "Laravel_capistrano"
set :repo_url, "git@github.com:fernandokbs/ecommerce.git"

set :branch, "Laravel-8"

set :deploy_to, '/var/www/laravel-capistrano'

set :keep_releases, 2

set :laravel_env_file, '/var/www/secrets/.env'

append  :linked_dirs, 
        'storage/app',
        'storage/framework/cache',
        'storage/framework/sessions',
        'storage/logs'

namespace :composer do
    desc "Install composer"
    task :install do
        on roles(:composer) do
            within release_path do
                execute :composer, "install --no-dev --quiet --prefer-dist --optimize-autoloader"
            end
        end
    end
end

namespace :laravel do
    task :fix_permissions do
        on roles(:laravel) do
            execute :sudo, "chmod", "-R ug+rwx #{shared_path}/storage/ #{release_path}/bootstrap/cache/"
            execute :sudo, :chgrp, "-R www-data #{shared_path}/storage/ #{release_path}/bootstrap/cache/"
        end
    end 

    task :configure_env do
        dotenv = fetch(:laravel_env_file)
        on roles(:laravel) do
            execute :cp, "#{dotenv} #{release_path}/.env"
        end
    end

    task :clean_views do
        on roles(:laravel) do
            execute "cd #{release_path} php artisan view:clear"
        end
    end
end

namespace :deploy do 
    after :updated, "composer:install"
    after :updated, "laravel:fix_permissions"
    after :updated, "laravel:configure_env"
end

# Default branch is :master
# ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp

# Default deploy_to directory is /var/www/my_app_name
# set :deploy_to, "/var/www/my_app_name"

# Default value for :format is :airbrussh.
# set :format, :airbrussh

# You can configure the Airbrussh format using :format_options.
# These are the defaults.
# set :format_options, command_output: true, log_file: "log/capistrano.log", color: :auto, truncate: :auto

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
# append :linked_files, "config/database.yml"

# Default value for linked_dirs is []
# append :linked_dirs, "log", "tmp/pids", "tmp/cache", "tmp/sockets", "public/system"

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for local_user is ENV['USER']
# set :local_user, -> { `git config user.name`.chomp }

# Default value for keep_releases is 5
# set :keep_releases, 5

# Uncomment the following to require manually verifying the host key before first deploy.
# set :ssh_options, verify_host_key: :secure
