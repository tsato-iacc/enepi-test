#!/bin/sh

cd `dirname $0`

aws configure list --profile enepi
echo "dl ok?"
read x

list="tmp certificates production staging development"

for i in ${list}
do
	echo "aws s3 cp s3://enepi/${i} ./data/${i}/ --profile enepi --recursive"
	aws s3 cp s3://enepi/${i} ./data/${i}/ --profile enepi --recursive
done


aws configure list --profile biz
echo "upload ok?"
read x

for i in ${list}
do
	echo "aws s3 cp ./data/${i}/ s3://enepi-new/${i}/ --profile biz --recursive"
	aws s3 cp ./data/${i}/ s3://enepi-new/${i}/ --profile biz --recursive
done

echo "success!"

