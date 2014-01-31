#!/bin/bash

if [ -z "$1" ]
then
    echo "Usage: $0 <lang>"
    exit 1
fi

D="$1/LC_MESSAGES"

#for D in */LC_MESSAGES
#do
    echo $D
    # make sure all po files exist
    if [ -e $D/core.po ]
    then
        cp $D/core.po $D/update.po
    else
        cp $D/browser-update.po $D/update.po
    fi
    cp $D/browser-update.po $D/site.po
    cp $D/browser-update.po $D/customize.po
    cp $D/browser-update.po $D/update-legacy.po
    # update using new templates
    msgmerge -U $D/update.po update.pot
    msgmerge -U $D/site.po site.pot
    msgmerge -U $D/customize.po customize.pot
    msgmerge -U $D/update-legacy.po update-legacy.pot
#done

