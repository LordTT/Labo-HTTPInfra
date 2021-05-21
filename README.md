# Labo-HTTPInfra
Repo for the HTTPInfra lab

## Part1

### Demo

To build and run the docker image for part one yon need to go in the `docker-images\apache-php-image` folder and run the commands:

        docker build -t res/apache_php .
        docker run -d -p 9090:80 res/apache_php
        
You will then be able to see your website at the address `localhost:9090`.

### Dockerfile

In the Dockerfile we will first create the image based on the `php:7.2-apache` image and then copy the files for the host folder `/content` to the container folder `/var/www/html/`.

### Config files

You can get to the config files of the running image by running the command `docker exec -it YOU_CONTAINER_NAME /bin/bash`.

To find you container name you can use the `docker ps` command. 

Then navigate to the folder cointining the config files usind `cd /etc/apache2/`.

### Config

In our configuration the virtual host listens on the 80 port that will be forwarded to the port 9090 thanks to Docker.

The html content will be found int he `/var/www/html` folder.
