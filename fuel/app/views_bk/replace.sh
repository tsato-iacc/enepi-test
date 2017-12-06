#!/bin/sh

cd `dirname $0`

for i in `find . -name "*.php"`
do

	cat ${i} | sed -e "s/<%/<?/g" \
			-e "s/%>/?>/g" \
			-e "s/ end / } /g" \
			-e "s/ do / { /g" \
			-e "s/link_to /MyView::link_to(/g" \
			-e "s/image_tag /MyView::image_tag(/g" \
			-e "s/class:/[\"class\" =>/g" \
			-e "s/onclick:/\"onclick\" =>/g" \
			-e "s/);\"/);\"]);/g" \
			-e "s/\" {/\"]); {/g" \
	> swap

	cp -p swap ${i}

done
