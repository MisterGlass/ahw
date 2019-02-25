# Installation
1. Open a terminal and change into project directory
2. Generate a self signed cert for localhost: `docker run -v {projectdir}/provisioning/certs:/certs -e SSL_SUBJECT=localhost paulczar/omgwtfssl`
3. Build & run the docker containers: `docker-compose up --build`
4. Install dependencies: `docker-compose run composer install`
5. Init database: `docker-compose exec php bin/console doctrine:migrations:migrate`
6. Load fixtures: `docker-compose exec php bin/console doctrine:fixtures:load`
