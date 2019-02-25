1. Generate a self signed cert for localhost: `docker run -v {projectdir}/provisioning/certs:/certs -e SSL_SUBJECT=localhost paulczar/omgwtfssl`
2. Build & run the docker containers: `docker-compose up --build`
3. Install dependencies: `docker-compose run composer install`
4. Init database: `docker-compose exec php bin/console doctrine:migrations:migrate`
5. Load fixtures: `docker-compose exec php bin/console doctrine:fixtures:load`
