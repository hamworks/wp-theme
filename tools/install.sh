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
WP_DEBUG=true
WP_THEME_UNIT_TEST=true
WP_THEME_UNIT_TEST_URL="https://raw.githubusercontent.com/WPTRT/theme-unit-test/master/themeunittestdata.wordpress.xml"
WP_ALWAYS_REST_DB=false

ROOT=$(cd $(dirname $0);cd ../;pwd)
ENV=${ROOT}/.env

# override variables.
eval "$(cat ${ENV} <(echo) <(declare -x))"

sleep 10

#
# Install WordPress
#
if ! $(wp core is-installed); then

	wp core download --path="/var/www/html" --version=${WP_VERSION} --locale=ja --skip-content --force

	if [ ${WP_PORT} = 80 ]; then
		wp core install --url="http://localhost" --title="DEMO" --admin_user="$WP_ADMIN_USER" --admin_password="$WP_ADMIN_PASS" --admin_email="admin@example.com" --path="/var/www/html"
	else
		wp core install --url="http://localhost:$WP_PORT" --title="DEMO" --admin_user="$WP_ADMIN_USER" --admin_password="$WP_ADMIN_PASS" --admin_email="admin@example.com" --path="/var/www/html"
	fi

	#
	# debug mode
	#
	if "${WP_DEBUG}"; then
		wp config set WP_DEBUG true --raw --type=constant
		wp config set JETPACK_DEV_DEBUG true --raw --type=constant
		wp config set SCRIPT_DEBUG true --raw --type=constant
	fi

		#
	#  import theme unit test
	#
	if "${WP_THEME_UNIT_TEST}"; then
		wp plugin install wordpress-importer --activate
		curl ${WP_THEME_UNIT_TEST_URL} -o /tmp/themeunittestdata.wordpress.xml
		wp import /tmp/themeunittestdata.wordpress.xml  --authors=create  --quiet
		wp option update posts_per_page 5
		wp option update page_comments 1
		wp option update comments_per_page 5
		wp option update show_on_front page
		wp option update page_on_front 701
		wp option update page_for_posts 703
	fi

	#
	# Localize.
	#
	wp language core install ja
	wp language core activate ja
	wp language core update
	wp option update timezone_string 'Asia/Tokyo'

	#
	# Remove Bundled Plugin.
	#
	wp plugin uninstall akismet
	wp plugin uninstall hello

	wp plugin activate --all
	wp language plugin install ja --all
	wp language plugin update --all
	wp theme activate ${WP_THEME}

fi

