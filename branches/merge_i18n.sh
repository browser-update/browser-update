cd i18n || exit 1
svn merge `svn info ../../trunk/ | grep -i url | awk '{print $2}'`
