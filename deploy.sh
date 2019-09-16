#!/bin/bash
docker kill constanceteste_php_1 crud_mysql_1 > /dev/null 2>&1
docker rm constanceteste_php_1 crud_mysql_1 > /dev/null 2>&1
docker-compose -f docker-compose-buld.yml up -d
