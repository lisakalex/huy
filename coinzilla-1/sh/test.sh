#!/bin/bash
for i in {1..29}
do
  /usr/bin/php8.1 /var/www/html/sh/test.php
#  /opt/lampp/bin/php /opt/lampp/htdocs/tihuy/test/test.php
  # shellcheck disable=SC2046
  sleep 2
done
