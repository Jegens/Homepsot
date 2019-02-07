# This framework requires an .htaccess file in the root directory with the following code in it, (to change root to the views folder) -

RewriteEngine On
RewriteBase /

RewriteCond %{REQUEST_URI} !^/views/
RewriteRule ^(.*)$ /views/$1 [L]
# Homepsot
