#!/bin/bash
for i in {1..29}
do
  /var/www/html/py/download_source.py
  # shellcheck disable=SC2046
  sleep 2
done