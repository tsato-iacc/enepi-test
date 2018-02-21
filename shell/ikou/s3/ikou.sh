#!/bin/sh

cd `dirname $0`

aws configure list --profile enepi
echo "dl ok?"
read x

aws s3 cp s3://enepi/tmp ./tmp/ --profile enepi --recursive
aws s3 cp s3://enepi/certificates/ ./certificates/ --profile enepi --recursive
aws s3 cp s3://enepi/production/ ./production/ --profile enepi --recursive
aws s3 cp s3://enepi/staging/ ./staging/ --profile enepi --recursive
aws s3 cp s3://enepi/development/ ./development/ --profile enepi --recursive

aws configure list --profile biz
echo "upload ok?"
read x

aws s3 cp ./tmp/ s3://enepi-new/tmp/ --profile biz --recursive
aws s3 cp ./certificates/ s3://enepi-new/certificates/ --profile biz --recursive
aws s3 cp ./staging/ s3://enepi-new/staging/ --profile biz --recursive
aws s3 cp ./development/ s3://enepi-new/development/ --profile biz --recursive
aws s3 cp ./production/ s3://enepi-new/production/ --profile biz --recursive

echo "success!"

