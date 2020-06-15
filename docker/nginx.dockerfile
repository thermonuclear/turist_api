# Базовый образ с nginx и php
FROM nginx:1.19.0

# Удаляем конфиги сайтов которые там есть
RUN rm -Rf /etc/nginx/sites-enabled/*
# Добавляем наш конфиг
ADD nginx/site.conf /etc/nginx/sites-available/site.conf
# Включаем его
RUN ln -s /etc/nginx/sites-available/site.conf /etc/nginx/sites-enabled/site.conf