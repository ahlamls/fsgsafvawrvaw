#!/bin/bash

# Specify the WordPress version you want to fetch
WP_VERSION="latest"

# Specify your project directory
#PROJECT_DIR="/path/to/your/project"

# Navigate to the project directory
#cd "$PROJECT_DIR" || exit

# Fetch the WordPress core
echo "Downloading Latest WordPress.org zip"
curl -O https://wordpress.org/wordpress-"$WP_VERSION".tar.gz

# Unzip the WordPress core
tar -xzvf wordpress-"$WP_VERSION".tar.gz

# Create directories if they don't exist
mkdir -p wp-includes
mkdir -p wp-admin

# Copy core files to the project root
cp -R wordpress/wp-includes/* wp-includes/
cp -R wordpress/wp-admin/* wp-admin/

# Clean up
rm -rf wordpress
rm wordpress-"$WP_VERSION".tar.gz

# Create a wp-config.php
#mv wp-config-sample.php wp-config.php

# Generate unique salts and replace them in wp-config.php
#SALTS=$(curl -s https://api.wordpress.org/secret-key/1.1/salt/)
#sed -i -e "/put your unique phrase here/d" -e "/AUTH_KEY/s/put your unique phrase here/$(echo $SALTS | sed -n '1p')/" wp-config.php
#sed -i -e "/SECURE_AUTH_KEY/s/put your unique phrase here/$(echo $SALTS | sed -n '2p')/" wp-config.php
#sed -i -e "/LOGGED_IN_KEY/s/put your unique phrase here/$(echo $SALTS | sed -n '3p')/" wp-config.php
#sed -i -e "/NONCE_KEY/s/put your unique phrase here/$(echo $SALTS | sed -n '4p')/" wp-config.php
#sed -i -e "/AUTH_SALT/s/put your unique phrase here/$(echo $SALTS | sed -n '5p')/" wp-config.php
#sed -i -e "/SECURE_AUTH_SALT/s/put your unique phrase here/$(echo $SALTS | sed -n '6p')/" wp-config.php
#sed -i -e "/LOGGED_IN_SALT/s/put your unique phrase here/$(echo $SALTS | sed -n '7p')/" wp-config.php
#sed -i -e "/NONCE_SALT/s/put your unique phrase here/$(echo $SALTS | sed -n '8p')/" wp-config.php

echo "WordPress wp-includes and wp-admin folders copied, wp-config.php set up!"
