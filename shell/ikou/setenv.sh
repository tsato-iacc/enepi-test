#!/bin/sh

echo "eb use enepi-production"
eb use enepi-production
eb list

echo

echo "1:real db *"
echo "2:old db"
read x

if [ "x${x}" = "x" ]
then
 	x=1
fi



if [ ${x} -eq 1 ]
then
	# real
	RDS_HOSTNAME="enepi-production.cgnyosygrcom.ap-northeast-1.rds.amazonaws.com"
	RDS_PORT="3306"
	S3_BUCKET="enepi-new"
	AWS_ACCESS_KEY_ID="AKIAJG37BGJTSL6ZHTFA"
	AWS_SECRET_ACCESS_KEY="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"

elif [ ${x} -eq 2 ]
then
	RDS_HOSTNAME="127.0.0.1"
	RDS_PORT="3308"
	S3_BUCKET="enepi"
	AWS_ACCESS_KEY_ID="AKIAI2NFTZUSEGDK5E4Q"
	AWS_SECRET_ACCESS_KEY="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"

else
	echo "exit..."
	exit 1
fi


echo eb setenv RDS_HOSTNAME="${RDS_HOSTNAME}" RDS_PORT="${RDS_PORT}" S3_BUCKET="${S3_BUCKET}" AWS_ACCESS_KEY_ID="${AWS_ACCESS_KEY_ID}" AWS_SECRET_ACCESS_KEY="${AWS_SECRET_ACCESS_KEY}"

echo "ok ?!!"
read x

eb setenv RDS_HOSTNAME="${RDS_HOSTNAME}" RDS_PORT="${RDS_PORT}" S3_BUCKET="${S3_BUCKET}" AWS_ACCESS_KEY_ID="${AWS_ACCESS_KEY_ID}" AWS_SECRET_ACCESS_KEY="${AWS_SECRET_ACCESS_KEY}"

