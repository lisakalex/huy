#!/bin/bash
for i in {1..60}
do
#  /var/www/html/venv/bin/python3.10 /var/www/html/py/alexa/alexa-sel-1.py
  /var/www/html/venv/bin/python3.10 /var/www/html/py/alexa/alexa.py
  # shellcheck disable=SC2046
  sleep 1
done
