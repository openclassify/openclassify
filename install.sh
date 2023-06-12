#!/bin/bash

echo "================================================"
echo "----------------- Openclassify -----------------"
echo "----- Automated install script with Docker -----"
echo "================================================"

if [[ $(which docker) && $(docker --version) ]]; then
    docker --version

    #if ubuntu install docker
        if [  -n "$(uname -a | grep Ubuntu)" ]; then
          if ! docker info > /dev/null 2>&1; then
            systemctl --user start docker-desktop
            echo "Docker is not running. I've started for you. Run it again"
            exit
          fi
        fi
  else
    #if ubuntu install docker
    if [  -n "$(uname -a | grep Ubuntu)" ]; then
        sudo apt-get update
        sudo apt-get install ca-certificates curl gnupg
        sudo install -m 0755 -d /etc/apt/keyrings
        curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
        sudo chmod a+r /etc/apt/keyrings/docker.gpg
        echo \
          "deb [arch="$(dpkg --print-architecture)" signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
          "$(. /etc/os-release && echo "$VERSION_CODENAME")" stable" | \
        sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
        sudo apt-get update
        sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin


    else
        echo "Install docker and come back later"
        exit
    fi
fi

cp  .env-sail .env

docker compose down -v

docker compose build --no-cache

docker compose up --force-recreate

#
#docker exec -it oc_php php artisan install --ready

#php artisan migrate --all-addons --force

#composer config http-basic.abc.aaa.com openclassify pass
#composer config repositories.repo-name composer https://abc.aaa.com
