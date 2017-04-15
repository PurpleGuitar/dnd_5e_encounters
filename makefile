all: php/index.php
	rm -rf deploy/*
	cp php/*.php deploy
	cp -r data deploy
