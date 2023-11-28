## Requirements for building and running the application

- [Composer](https://getcomposer.org/download/) in case of you are preferring to run the app in your host. 
  - Please not that all the below examples are with [sail](https://laravel.com/docs/10.x/sail)
- [Docker](https://docs.docker.com/get-docker/)

## Application Build and Run

After cloning the repository get into the `ventura.pro` directory and run:

`cp .env.example .env`

`./vendor/bin/sail up`

`./vendor/bin/sail composer install`

`./vendor/bin/sail npm i && npm run dev`

`./vendor/bin/sail artisan migrate:fresh --seed` (optional)

Go to [http://localhost](http://localhost) in order to see the application running.

## Deployment
- merging a PR into `master` branch will trigger the deployment
- check the `forge.sh` for detailed info
- Go to [Forge](https://forge.laravel.com/docs/introduction.html) to read the documentation 

## Contribution
- a coding style is enforced by [Duster](https://github.com/tighten/duster) & [PhpStan](https://phpstan.org/writing-php-code/phpdocs-basics)
  - manual check by `./vendor/bin/sail bin duster lint`
  - manual fix by `./vendor/bin/sail bin duster fix`
- on each commit an auto check/fix will be executed without fixing the issues the commit will fail
- if somehow one will push with `--no-verify` a github action will be triggered which will create a commit on the top of the PR with the needed fixes
- to enhance the IDE's autocomplete we are using a helper to generate the ide helper file. for more [details](https://github.com/barryvdh/laravel-ide-helper)
- in order to merge a PR an approval is required
