#!/bin/bash

cd /home/projeto && dep rollback && cp .env /var/www/html/shared/storage/.env && chmod 777 -R /var/www/html/shared/storage/

