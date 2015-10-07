all: composer-install clear-cache db fixtures bower-install compile test

db:
	php app/console doctrine:database:drop --force
	php app/console doctrine:database:create
	php app/console doctrine:schema:update --force

fixtures:
	php app/console doctrine:fixtures:load -n

clear-cache:
	rm -rf app/cache/dev/*
	rm -rf app/cache/test/*
	rm -rf app/cache/prod/*
	php app/console cache:clear
	php app/console cache:clear --env=prod

composer-install:
	composer install

compile:
	php app/console assetic:dump
	php app/console assets:install web
	mkdir -p web/css && cp -au bower_components/bootstrap/dist/css/bootstrap.css.map web/css/
	mkdir -p web/fonts && cp -au bower_components/bootstrap/fonts/* web/fonts/

watch:
	php app/console assetic:watch

bower-install:
	bower prune
	bower install

permissions:
	HTTPDUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
	sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
	sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs

test:
	phpunit -c app/
