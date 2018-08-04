#!/bin/bash

if [ $# != 1 ]
	then
		echo "Need Image Name ==> img.xxx"
	else
		identify -format '%[EXIF:*]' $1 | grep ".*Latitude=.*\|.*Longitude=.*"
fi
