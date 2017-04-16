build: php/index.php
	rm -rf bin/*
	cp php/*.php bin
	cp -r data bin

run: build
	xdg-open http://localhost &
