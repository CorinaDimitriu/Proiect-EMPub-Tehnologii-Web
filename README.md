### About .htacces files

#### There are 2 of them. The first one is located in the public folder of the microservice and contains:

 Options -Indexes


#### The second one is located in the microservice backend folder and contains:

 Options -MultiViews
 RewriteEngine On

 RewriteBase /public
 RewriteCond %{REQUEST_FILENAME} !-d
 RewriteCond %{REQUEST_FILENAME} !-f

 RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]

