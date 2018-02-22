#!/bin/sh

cd `dirname $0`

host="/hostedzone/Z2IOGBKJQ59EY6"

#aws route53 list-hosted-zones --profile enepi
#aws route53 list-resource-record-sets --hosted-zone-id /hostedzone/Z290ZZS70XXQVE
#aws route53 change-resource-record-sets --hosted-zone-id /hostedzone/Z290ZZS70XXQVE --change-batch file:///tmp/create_dns_recordset.json


f="./create.dns.json"

#aws route53 list-resource-record-sets --hosted-zone-id ${host} --query "ResourceRecordSets[?Name == 'testtest.enepi.jp.']"
aws route53 list-resource-record-sets --hosted-zone-id ${host}



cat ${f}
echo "aws route53 change-resource-record-sets --hosted-zone-id ${host} --change-batch file://${f}"
echo "ok?"
read x
aws route53 change-resource-record-sets --hosted-zone-id ${host} --change-batch file://${f}

