#!/bin/sh

cd `dirname $0`

for i in `find . -name "*.php" | grep shared`
do

	o="../views_bk/${i}"
	cat ${o} | sed -e "s/<%/<?/g" \
			-e "s/%>/?>/g" \
			-e "s/ end / } /g" \
			-e "s/ do / { /g" \
			-e "s/<?-/<?/g" \
			-e "s|<?#|<?//|g" \
			-e "s/link_to /MyView::link_to(/g" \
			-e "s/image_tag /MyView::image_tag(/g" \
			-e "s/form_tag/MyView::form_tag/g" \
			-e "s/class:/[\"class\" =>/g" \
			-e "s/method:/[\"method\" =>/g" \
			-e "s/onclick:/\"onclick\" =>/g" \
			-e "s/);\"/);\"]);/g" \
			-e "s/\" {/\"]); {/g" \
			-e "s/ title / MyView::title(/g" \
			-e "s/ description / MyView::description(/g" \
			-e "s/') {/']); {/g" \
	> swap

	#cp -p swap ${i}
	cp -p swap ${i}
	echo ${i}

done
