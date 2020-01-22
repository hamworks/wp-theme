#!/bin/bash
set -x
#
# Variables
#
WP_VERSION="latest"
WP_THEME="twentynineteen"
WP_PORT=80
WP_ADMIN_USER="admin"
WP_ADMIN_PASS="password"
WP_LOCALE="en_US"
WP_TIMEZONE=""
WP_DEBUG=true
WP_THEME_UNIT_TEST=true
WP_THEME_UNIT_TEST_URL="https://raw.githubusercontent.com/WPTRT/theme-unit-test/master/themeunittestdata.wordpress.xml"
WP_ALWAYS_REST_DB=false

ROOT=$(cd $(dirname $0);cd ../;pwd)
ENV=${ROOT}/.env

# override variables.
eval "$(cat ${ENV} <(echo) <(declare -x))"

#
# Install WordPress
#
docker-compose up -d

sleep 10

docker-compose run --rm cli wp core download --path="/var/www/html" --version=${WP_VERSION} --locale=ja --skip-content --force
docker-compose run --rm cli wp db reset --yes

if [ ${WP_PORT} = 80 ]; then
	docker-compose run --rm cli wp core install --url="http://localhost" --title="DEMO" --admin_user="$WP_ADMIN_USER" --admin_password="$WP_ADMIN_PASS" --admin_email="admin@example.com" --path="/var/www/html"
else
	docker-compose run --rm cli wp core install --url="http://localhost:$WP_PORT" --title="DEMO" --admin_user="$WP_ADMIN_USER" --admin_password="$WP_ADMIN_PASS" --admin_email="admin@example.com" --path="/var/www/html"
fi

docker-compose run --rm -uroot cli chmod 767 /var/www/html/wp-content
docker-compose run --rm -uroot cli chmod -R 767 /var/www/html/wp-content/plugins
docker-compose run --rm -uroot cli chmod -R 767 /var/www/html/wp-content/uploads

#
# debug mode
#
if "${WP_DEBUG}"; then
	docker-compose run --rm cli wp config set WP_DEBUG true --raw --type=constant
	docker-compose run --rm cli wp config set JETPACK_DEV_DEBUG true --raw --type=constant
	docker-compose run --rm cli wp config set SCRIPT_DEBUG true --raw --type=constant
fi

#
# Setup Theme and Plugins.
#
docker-compose run --rm cli wp plugin install wordpress-importer --activate
docker-compose run --rm cli wp language plugin install ja --all
docker-compose run --rm cli wp language plugin update --all
docker-compose run --rm cli wp theme activate ${WP_THEME}


#
#  import theme unit test
#
if "${WP_THEME_UNIT_TEST}"; then
	docker-compose run --rm cli sh -c "curl ${WP_THEME_UNIT_TEST_URL} -o /tmp/themeunittestdata.wordpress.xml && wp import /tmp/themeunittestdata.wordpress.xml  --authors=create --quiet"
	docker-compose run --rm cli wp option update posts_per_page 5
	docker-compose run --rm cli wp option update page_comments 1
	docker-compose run --rm cli wp option update comments_per_page 5
	docker-compose run --rm cli wp option update show_on_front page
	docker-compose run --rm cli wp option update page_on_front 701
	docker-compose run --rm cli wp option update page_for_posts 703
fi

#
# Localize.
#
if [[ ${WP_LOCALE} != 'en_US' ]]; then
	docker-compose run --rm cli wp language core install ${WP_LOCALE}
	docker-compose run --rm cli wp language core activate ${WP_LOCALE}
	docker-compose run --rm cli wp language core update
fi

if [[ ${WP_TIMEZONE} ]]; then
	docker-compose run --rm cli wp option update timezone_string ${WP_TIMEZONE}
fi

docker-compose down
