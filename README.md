# Precious Metals API


## Getting Started in local environment

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --no-cache` to build fresh images
3. Run `docker compose up --pull always -d --wait` to set up and start a fresh Symfony project
4. Add virtual host in your system (for example in Windows: `127.0.0.1 precious-metals-api.local`)
5. Open `https://precious-metals-api.local` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
6. Run `docker compose down --remove-orphans` to stop the Docker containers.


docker exec -it precious-metals-api-php-1 php bin/console doctrine:migrations:migrate
docker exec -it precious-metals-api-php-1 php bin/console doctrine:fixtures:load

GOLD_API_KEY
