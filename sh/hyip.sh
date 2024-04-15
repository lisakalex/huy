#!/bin/bash
for i in {1..60}
do
  /usr/bin/php8.1 /var/www/html/sh/hyip.php
  # shellcheck disable=SC2046
  sleep 1
done
