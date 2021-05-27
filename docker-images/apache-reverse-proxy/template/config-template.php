<VirtualHost *:80>
    ServerName demo.res.ch

    #ErrorLog ${APACHE_LOG_DIR}/error.log
    #CustomLog ${APACHE_LOG_DIR}/access.log combined

    ProxyPass "/api/students" "http://<?=getenv('DYNAMIC_APP')?>/"
    ProxyPassReverse "/api/students" "http://<?=getenv('DYNAMIC_APP')?>/"

    ProxyPass "/" "http://<?=getenv('STATIC_APP')?>/"
    ProxyPassReverse "/" "http://<?=getenv('STATIC_APP')?>/"
</VirtualHost>