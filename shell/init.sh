#!/bin/sh

cd `dirname $0`

echo "start"

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


for i in `ps -aef | grep ssh | grep ec2-user | grep ":3306" | grep -v grep`
do
	p=`echo ${i} | awk '{print $2}'`
	kill -9 ${p}
done

ssh -i /var/app/current/shell/pps-prod.pem -f -N -C -g -L *:3309:stg-common.cebp6jbs7ymd.ap-northeast-1.rds.amazonaws.com:3306 ec2-user@54.250.242.33
ssh -i /var/app/current/shell/pps-prod.pem -f -N -C -g -L *:3308:enepi-prod.cebp6jbs7ymd.ap-northeast-1.rds.amazonaws.com:3306 ec2-user@13.230.197.119

