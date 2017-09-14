FROM nginx:alpine

# Configures server
COPY docker/nginx/nginx.conf /etc/nginx/conf.d/default.conf

# Adds the application code to the container
WORKDIR /var/www/html
COPY web/app/themes/ web/app/themes/

VOLUME ["/var/www/html/web/app/uploads", "/var/log/nginx/"]
