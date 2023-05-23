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
          sudo apt-get install -y \
                apt-transport-https \
                ca-certificates \
                curl \
                software-properties-common
            curl -fsSL https://yum.dockerproject.org/gpg | sudo apt-key add -
            sudo add-apt-repository \
                "deb https://apt.dockerproject.org/repo/ \
                ubuntu-$(lsb_release -cs) \
                main"
            sudo apt-get update
            sudo apt-get -y install docker-engine
            # add current user to docker group so there is no need to use sudo when running docker
            sudo usermod -aG docker $(whoami)
    else
        echo "Install docker and come back later"
        exit
    fi
fi

cp -u .env-sail .env

docker compose build
#--no-cache

docker compose up  -d

#
#docker exec -it oc_php php artisan install --ready

#php artisan migrate --all-addons --force

#composer config http-basic.abc.aaa.com openclassify pass
#composer config repositories.repo-name composer https://abc.aaa.com