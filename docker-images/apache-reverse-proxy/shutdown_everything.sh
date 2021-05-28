#!/bin/bash
# stop and delete all res containers
for id_container in $(sudo docker ps --format '{{.Image}},{{.Names}}' | grep res/ | cut -d',' -f2)
do
    sudo docker kill $id_container
    sudo docker rm $id_container
done