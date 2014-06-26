# OpenBuild - Core

## Not ready for use!

## Goals

1. Separation of concerns
2. Modularised services
3. SPA and traditional web interfaces
4. Accessible API for each service
5. Portable data repositories
6. SSL only
7. 100% unit tested
8. Continuous integration tested
9. Frontend optimisation

## Requirements

## Server setup
### Apache

```
RewriteEngine On
  
RewriteRule ^/index.php$ - [R=404]
  
RewriteCond %{DOCUMENT_ROOT}%{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d 
RewriteRule ^/(.*)$ /index.php [L]
  
ErrorLog /path/to/log
ErrorDocument 404 /404.html     

SSLEngine on
SSLCertificateFile /path/to/cert.crt
SSLCertificateKeyFile /path/to/key.key

BrowserMatch "MSIE [2-6]" \
	nokeepalive ssl-unclean-shutdown \
	downgrade-1.0 force-response-1.0
	# MSIE 7 and newer should be able to use keepalive
	BrowserMatch "MSIE [17-9]" ssl-unclean-shutdown

```