#!/bin/bash

echo "|| ## Openclassify ## || "
echo "||   Removing Bye bye || "

docker compose down -v
# TODO @fatihalp

# reinstall
docker compose build --no-cache

docker compose up  --force-recreate

