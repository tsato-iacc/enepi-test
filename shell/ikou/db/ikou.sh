#!/bin/sh

cd `dirname $0`

echo "mysqldump -u root -p'mi!8e$270e' -h 127.0.0.1 -P 3308 enepi_production > dump.prod"
mysqldump -u root -p'mi!8e$270e' -h 127.0.0.1 -P 3308 enepi_production > dump.prod

ls -l dump.prod

echo "upload OK?  ** prod"
read x

echo "mysql -u root -p'rootroot' -h enepi-production.cgnyosygrcom.ap-northeast-1.rds.amazonaws.com enepi_production < dump.prod"
mysql -u root -p'rootroot' -h enepi-production.cgnyosygrcom.ap-northeast-1.rds.amazonaws.com enepi_production < dump.prod
