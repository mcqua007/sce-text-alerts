#!/bin/bash

pids=""

function ctrl_c() {
  echo "** Trapped CTRL-C"
  docker-compose -f docker-compose.yml stop || true

  if [ -n "$pids" ]
    then
    kill -- $pids
fi

exit $?
}

CURRENT_DIR=${PWD##*/}
dockerName=${CURRENT_DIR//[^a-zA-Z0-9]/}
webContainerName="${dockerName}_node"

WEB_CONTAINER=""

function getWebContainer(){
  WEB_CONTAINER=$(docker ps -a | grep -Eo "$webContainerName[^ ]+") || true
}

if [ ! -f ./.env ]; then
  touch ./.env
fi

docker-compose -p "$dockerName" stop || true
docker-compose -p "$dockerName" build

# install composer packages
docker-compose -p "$dockerName" run -T --rm composer install &&

# install npm modules
docker-compose -p "$dockerName" up -d php-fpm
docker-compose -p "$dockerName" up -d nginx
docker-compose -p "$dockerName" up -d db

# run migrations
# docker-compose -p "$dockerName" exec php-fpm php artisan migrate

docker-compose -p "$dockerName" run -e "TERM=xterm-256color" -T --rm node /bin/bash -c 'npm install && gulp watch'

trap ctrl_c SIGINT SIGTERM INT TERM ERR

getWebContainer

echo "Web container is $WEB_CONTAINER"
docker attach --detach-keys='ctrl-d' $WEB_CONTAINER

ctrl_c
