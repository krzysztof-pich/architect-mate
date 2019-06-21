FROM httpd:2.4.33-alpine

RUN adduser -S kpich
ENV APACHE_RUN_USER kpich
ENV APACHE_RUN_GROUP kpich
RUN apk update; \
    apk upgrade;

RUN sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf


# Copy apache vhost file to proxy php requests to php-fpm container
COPY default.apache.conf /usr/local/apache2/conf/default.apache.conf
RUN echo "Include /usr/local/apache2/conf/default.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf
