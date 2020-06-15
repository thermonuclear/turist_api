# Базовый образ с nginx и php
FROM nginx:1.19.0

# Удаляем конфиги сайтов которые там есть
#RUN rm -Rf /etc/nginx/conf.d/*
# Добавляем наш конфиг
#COPY nginx/site.conf /etc/nginx/conf.d
