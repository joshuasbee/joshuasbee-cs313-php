#!/bin/sh
cd ~/Library/Mobile\ Documents/com~apple~CloudDocs/BYUIdaho/Winter21/Web/cs313-php

GIT=`which git`
REPO_DIR=/home/username/Sites/git/repo/
cd ${REPO_DIR}
${GIT} add --all .
${GIT} commit -m "Test commit"
${GIT} push heroku master
