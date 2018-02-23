#!/bin/sh -x

cd `dirname $0`

date
echo "start"
pwd

sts=1
if [ -f ~/.ssh/config ]
then
	cat ~/.ssh/config | grep "StrictHostKeyChecking" > /dev/null
	sts=$?
fi

if [ $sts -ne 0 ]
then
	echo "cat `pwd`/ssh_off.txt > ~/.ssh/config"
	cat `pwd`/ssh_off.txt > ~/.ssh/config
fi


for p in `ps -aef | grep ssh | grep ec2-user | grep ":3306" | grep -v grep | awk '{print $2}'`
do
	kill -9 ${p}
done

ssh -i `pwd`/pps-prod.pem -f -N -C -g -L *:3309:stg-common.cebp6jbs7ymd.ap-northeast-1.rds.amazonaws.com:3306 ec2-user@54.250.242.33
ssh -i `pwd`/pps-prod.pem -f -N -C -g -L *:3308:enepi-prod.cebp6jbs7ymd.ap-northeast-1.rds.amazonaws.com:3306 ec2-user@13.230.197.119


sudo cp /etc/localtime /etc/localtime.org
sudo ln -sf  /usr/share/zoneinfo/Asia/Tokyo /etc/localtime


cp `pwd`/../public/.htaccess.prod `pwd`/../public/.htaccess
#cp `pwd`/../public/.htaccess.close `pwd`/../public/.htaccess



date
echo "fin!"
echo
