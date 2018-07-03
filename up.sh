#!/usr/bin/env bash

git fetch upstream
git checkout master
git merge upstream/master
js=update.npm.full.js
git checkout upstream/master $js

VSAKT=$(curl -v --silent http://browser-update.org/update.npm.full.js --stderr - | egrep -oe 'vsakt\s*=\s*[^;]+')
perl -pi -e "s/vsakt\s*=\s*[^;]+/${VSAKT}/" $js
perl -pi -e 's/i\.src=[^;]+;//' $js
perl -pi -e 's/\+"#"\+tv\+":"\+op.pageurl//' $js
perl -pi -e 's/url\(.+?\)//' $js
perl -pi -e 's/"noopener"/"noopener noreferrer"/' $js
perl -pi -e 's/\+\s?":"\s?\+\s?op.pageurl//' $js
git diff
