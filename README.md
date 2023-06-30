# Генератор коротких ссылок

1. Требования к окружению:
    1. Docker
    1. Docker Compose
1. Инструкция по развертыванию:
    1. `git clone git@github.com:patric-chuzhbe/url-shorter-rest-docker.git`
    1. `cd url-shorter-rest-docker`
    1. `cp .env.example .env`
    1. В "docker-compose.yml" можно __при необходимости__ задать собственные значения для элементов:
        1. `services.app.container_name`
        1. `services.app.volumes[1]`
        1. `volumes.db-data-url-shorter-app-rest-docker` (имеется ввиду само имя тома для постоянного хранилища состояния БД)
    1. `docker-compose up --build`
    1. После сборки и запуска контейнера, открыть еще одну консоль в директории проекта:
        1. `sudo docker exec -it url-shorter-app-rest-docker bash`
        1. `php artisan migrate`
    1. В проекте ассеты скомпилированы. __При необходимости__, можно:
        1. Установить Node.js на хост ОС (проект разрабатывался и тестировался на версии 18.16)
        1. Выполнить в консоли в директории проекта:
            1. `npm i`
            1. `npm run watch` - вотчер для интерактивной разработки
    1. В браузере открыть URL http://localhost/
1. __При необходимости__,можно подключиться к БД проекта по следующим реквизитам:
    1. `HOST=127.0.0.1`
    1. `PORT=3306`
    1. `DATABASE=url_shorter`
    1. `USERNAME=alt_root`
    1. `PASSWORD=12345`
