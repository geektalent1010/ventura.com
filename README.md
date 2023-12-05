[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2Fa6c72835-a21e-4f6c-a2ed-f1948abd086b%3Fdate%3D1%26commit%3D1&style=flat-square)](https://forge.laravel.com/servers/738683/sites/2177792)
## Requirements for building and running the application

- [Composer](https://getcomposer.org/download/) in case of you are preferring to run the app in your host. 
  - Please note that all the below examples are with [sail](https://laravel.com/docs/10.x/sail)
- [Docker](https://docs.docker.com/get-docker/)

## Application Build and Run

After cloning the repository get into the `ventura.pro` directory and run:

`cp .env.dev .env`

`./vendor/bin/sail up`

`./vendor/bin/sail composer install`

`./vendor/bin/sail npm i && npm run dev`

`./vendor/bin/sail artisan migrate:fresh --seed` (optional)

Without sail:
 - `composer install`
 - `php artisan serve`
 - obviously the rest of the command above with direct `php` command where `php` version is `8.2`

Go to [http://localhost](http://localhost) in order to see the application running.

## Deployment
- merging a PR into `master` branch will trigger the deployment
- check the `forge.sh` for detailed info
- Go to [Forge](https://forge.laravel.com/docs/introduction.html) to read the documentation 

## Contribution
- a coding style is enforced by [Duster](https://github.com/tighten/duster) & [PhpStan](https://phpstan.org/writing-php-code/phpdocs-basics)
  - manual check by `./vendor/bin/sail bin duster lint` (`php ./vendor/bin/duster lint` without docker)
  - manual fix by `./vendor/bin/sail bin duster fix` (`php ./vendor/bin/duster fix` without docker)
- on each commit an auto check/fix will be executed without fixing the issues the commit will fail
- to enhance the IDE's autocomplete we are using a helper to generate the ide helper file. for more [details](https://github.com/barryvdh/laravel-ide-helper)
- the env file is encrypted, forge has the encryption key. the file is restored by forge after each deploy.
    - important note: Do not push `.env.example` because forge will use it as `.env` [read more](https://forge.laravel.com/docs/sites/deployments.html)
- in order to merge a PR:
  - an approval is required
  - `duster` status check needs to pass
  - branch must be in sync with master



