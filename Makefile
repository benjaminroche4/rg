#make start (symfony)
start:
	@echo "\033[0;32mStarting Symfony server...\033[0m"
	symfony server:start --no-tls

#make watch (npm)
watch:
	@echo "\033[0;32mStarting NPM server...\033[0m"
	npm run watch


#make install (composer)
install:
	@echo "\033[0;32mInstalling composer...\033[0m"
	composer install