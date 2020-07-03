FROM phpmyadmin/phpmyadmin:latest

# настраиваем время сессии в php и валидность куки в phpmyadmin на 1 сутки
RUN set -ex; \
    \
    { \
        echo 'session.gc_maxlifetime = 86400'; \
    } >> $PHP_INI_DIR/conf.d/session-strict.ini; \
    \
    { \
        echo '$cfg["LoginCookieValidity"] = 86400;'; \
    } >> /etc/phpmyadmin/config.inc.php;

# ставим пакеты
RUN apt-get update && apt-get install -y \
    mc
