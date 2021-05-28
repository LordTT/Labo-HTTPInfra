#!/bin/bash
# We asume that the required images are already build

static_id=$(sudo docker run -d res/apache_php)
dynamic_id=$(sudo docker run -d res/express_students)

ip_static=$(sudo docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $static_id)
ip_dynamic=$(sudo docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $dynamic_id)

sudo docker run -d -e STATIC_APP=$ip_static -e DYNAMIC_APP=$ip_dynamic:3000 -p 8080:80 res/apache_rp
echo "satique: $ip_static"
echo "dynamique: $ip_dynamic"