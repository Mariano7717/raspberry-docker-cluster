#!/bin/bash

docker build --force-rm --no-cache --build-arg BUILD_STRING="$(date -u)" --build-arg BUILD_DATE="$(date +%d-%m-%Y)" --build-arg BUILD_TIME="$(date +%H:%M:%S)" -t 3cx_stage1 .
docker run -d --privileged --name 3cx_stage1_c 3cx_stage1
docker exec 3cx_stage1_c bash -c \
" systemctl mask systemd-logind console-getty.service container-getty@.service getty-static.service getty@.service serial-getty@.service getty.target \
&& systemctl enable nginx exim4 postgresql \
&& echo 1 | apt-get -y install 3cxpbx"
docker stop 3cx_stage1_c
docker commit 3cx_stage1_c farfui/3cx:15.5
docker push farfui/3cx:15.5
docker rm 3cx_stage1_c
docker rmi 3cx_stage1
