<VirtualHost *:80>
    ServerName demo.res.ch

    #ErrorLog ${APACHE_LOG_DIR}/error.log
    #CustomLog ${APACHE_LOG_DIR}/access.log combined

	Header add Set-Cookie "ROUTEID=.%{BALANCER_WORKER_ROUTE}e; path=/" env=BALANCER_ROUTE_CHANGED
	
    <Proxy balancer://dynamic_app>
        BalancerMember 'http://<?=getenv('DYNAMIC_APP_1')?>'
        BalancerMember 'http://<?=getenv('DYNAMIC_APP_2')?>'
    </Proxy>

    <Proxy balancer://static_app>
        BalancerMember 'http://<?=getenv('STATIC_APP_1')?>' route=1
        BalancerMember 'http://<?=getenv('STATIC_APP_2')?>' route=2
		ProxySet lbmethod=byrequests
        ProxySet stickysession=ROUTEID
    </Proxy>
	
	<Location "/balancer-manager">
		SetHandler balancer-manager
	</Location>
	ProxyPass /balancer-manager !
	
    ProxyPass "/api/students" "balancer://dynamic_app/"
    ProxyPassReverse "/api/students" "balancer://dynamic_app/"

    ProxyPass "/" "balancer://static_app/"
    ProxyPassReverse "/" "balancer://static_app/"
</VirtualHost>