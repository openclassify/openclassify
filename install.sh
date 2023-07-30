#!/bin/bash

echo "================================================"
echo "----------------- Openclassify -----------------"
echo "----- Automated install script with Docker -----"
echo "================================================"

docker --version 
cp .env-sail .env
docker compose up