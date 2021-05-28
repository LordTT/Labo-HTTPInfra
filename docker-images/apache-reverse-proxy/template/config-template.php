<VirtualHost *:80>
    ServerName demo.res.ch

    #ErrorLog ${APACHE_LOG_DIR}/error.log
    #CustomLog ${APACHE_LOG_DIR}/access.log combined

	
    <Proxy balancer://dynamic_app>
        BalancerMember 'http://<?=getenv('DYNAMIC_APP_1')?>'
        BalancerMember 'http://<?=getenv('DYNAMIC_APP_2')?>'
    </Proxy>

    <Proxy balancer://static_app>
        BalancerMember 'http://<?=getenv('STATIC_APP_1')?>'
        BalancerMember 'http://<?=getenv('STATIC_APP_2')?>'
    </Proxy>
	
    ProxyPass "/api/students" "balancer://dynamic_app/"
    ProxyPassReverse "/api/students" "balancer://dynamic_app/"

    ProxyPass "/" "balancer://static_app/"
    ProxyPassReverse "/" "balancer://static_app/"
</VirtualHost>