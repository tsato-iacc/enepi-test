#!/bin/sh


echo "1:stg"
echo "2:prod"

read x
if [ "x${x}" = "x1" ] || [ "x${x}" = "x" ]
then
	mysql -u root -p'rootroot' -h enepi-staging.cgnyosygrcom.ap-northeast-1.rds.amazonaws.com pps_stg
elif [ "x${x}" = "x2" ]
then
	mysql -u root -p'rootroot' -h enepi-production.cgnyosygrcom.ap-northeast-1.rds.amazonaws.com enepi_production
fi
