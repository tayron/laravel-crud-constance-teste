#!/bin/sh

netstat -nr | grep '^0\.0\.0\.0' | awk '{print $2 " conexao_externa"}' >> /etc/hosts
