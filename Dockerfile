FROM adhocore/phpfpm:8.1

RUN \
  # prepare
  echo @legacy https://dl-cdn.alpinelinux.org/alpine/v3.12/community >> /etc/apk/repositories \
  # install
  && apk add -U --no-cache \
    bash \
    shadow \
    beanstalkd \
    memcached \
    mysql mysql-client \
    nano \
    nginx \
    redis \
    supervisor \
  # cleanup
  && rm -rf /var/cache/apk/* /tmp/* /var/tmp/* /usr/share/doc/* /usr/share/man/*

RUN id -u www-data >/dev/null 2>&1 || useradd -m -d /var/www/html -s /bin/bash www-data \
    && mkdir -p /var/log/php_unit && chown -R www-data:root /var/log/php_unit

# nginx config
COPY nginx/nginx.conf /etc/nginx/nginx.conf
COPY nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf

# supervisor config
COPY \
  beanstalkd/beanstalkd.ini \
  memcached/memcached.ini \
  mysql/mysql.ini \
  nginx/nginx.ini \
  php/php-fpm.ini \
  redis/redis.ini \
    /etc/supervisor.d/

# entrypoint
COPY docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

# ports
EXPOSE 3306 88 80

# commands
ENTRYPOINT ["/docker-entrypoint.sh"]
CMD ["supervisord", "-n", "-j", "/supervisord.pid"]
