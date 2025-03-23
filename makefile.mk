# Define the variable for PHP container ID
PHP_CONTAINER_ID := c4428acf03d0b1a1755c8257494da0c685b3f910c050078466799b94d8adf1ab

install-composer-lib:
	docker exec -it $(PHP_CONTAINER_ID) sh -c "composer require <your-lib>" && \
	docker cp $(PHP_CONTAINER_ID):/var/www/html/vendor .

clear-cache:
	docker exec -it $(PHP_CONTAINER_ID) sh -c 'php bin/console cache:clear'

cp-var:
	docker cp $(PHP_CONTAINER_ID):/var/www/html/var .

cp-vendor:
	docker cp $(PHP_CONTAINER_ID):/var/www/html/vendor .