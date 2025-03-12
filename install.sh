#!/bin/bash

# Function to convert string to lowercase
tolower() {
    echo "$1" | tr '[:upper:]' '[:lower:]'
}

# Function to convert string to uppercase
toupper() {
    echo "$1" | tr '[:lower:]' '[:upper:]'
}

# Function to properly capitalize words
totitle() {
    echo "$1" | awk '{for(i=1;i<=NF;i++)sub(/./,toupper(substr($i,1,1)),$i)}1'
}

# Ask for the new theme name
echo "Enter your theme name (press Enter for 'My Awesome Theme'):"
read theme_name
theme_name="${theme_name:-My Awesome Theme}"

# Ask for the author name
echo "Enter author name (press Enter for 'Online Klik B.V.'):"
read author_name
author_name="${author_name:-Online Klik B.V.}"

# Ask for the theme URI
echo "Enter author URI (press Enter for 'https://www.onlineklik.nl'):"
read theme_uri
theme_uri="${theme_uri:-https://www.onlineklik.nl}"

# Convert theme name to different formats
theme_name_lower=$(tolower "${theme_name// /}")
theme_name_title="$theme_name"
local_domain="${theme_name_lower}.test"

# Ask for the local development URL
echo "Enter database name (press Enter for '${theme_name_lower}'):"
read db_name
db_name="${db_name:-${theme_name_lower}}"

# Ask for the db user (press Enter for 'root')
echo "Enter database user (press Enter for 'root'):"
read db_user
db_user="${db_user:-root}"

# Ask for the db password (press Enter for empty password)
echo "Enter database password (press Enter for empty password):"
read db_password
db_password="${db_password:-}"

# Ask for the db host (press Enter for '127.0.0.1')
echo "Enter database host (press Enter for '127.0.0.1'):"
read db_host
db_host="${db_host:-127.0.0.1}"

# Navigate to the theme directory
cd wp-content/themes/wpstarter

# composer install & npm install
composer install
npm install

# Update style.css
if [ -f "style.css" ]; then
    # Create a temporary file
    tmp_file=$(mktemp)

    cat > "$tmp_file" << EOF
/*
Theme Name:         ${theme_name_title}
Theme URI:          ${theme_uri}
Description:        ${theme_name_title} is a WordPress theme developed by ${author_name}.
Version:            1.0.0
Author:             ${author_name}
Author URI:         ${theme_uri}
Text Domain:        sage
License:            MIT License
License URI:        https://opensource.org/licenses/MIT
Requires PHP:       8.2
Requires at least:  5.9
*/

/*
Do not add your styles here. Add your custom styles resources/styles/app.css.
Do not forget to run "npm run dev" when you are developing and "npm run build" when you are ready to deploy.
*/
EOF

    # Move the temporary file back to style.css
    mv "$tmp_file" style.css
    echo "Updated style.css"
else
    echo "Warning: style.css not found"
fi

# Update vite.config.js
if [ -f "vite.config.js" ]; then
    # Create a temporary file
    tmp_file=$(mktemp)

    cat > "$tmp_file" << EOF
import {defineConfig} from 'vite'
import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin'
import {
  wordpressPlugin,
  wordpressRollupPlugin,
  wordpressThemeJson,
} from './resources/js/build/wordpress'

export default defineConfig({
  base: '/wp-content/themes/${theme_name_lower}/public/build/',
  plugins: [
    tailwindcss(),
    laravel({
      detectTls: '${local_domain}',
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/editor.css',
        'resources/js/editor.js',
      ],
      refresh: true,
    }),

    wordpressPlugin(),
    wordpressRollupPlugin(),

    wordpressThemeJson({
      disableTailwindColors: false,
      disableTailwindFonts: false,
      disableTailwindFontSizes: false,
    }),
  ],
  resolve: {
    alias: {
      '@scripts': '/resources/js',
      '@styles': '/resources/css',
      '@fonts': '/resources/fonts',
      '@images': '/resources/images',
    },
  },
})
EOF

    # Move the temporary file back to vite.config.js
    mv "$tmp_file" vite.config.js
    echo "Updated vite.config.js"
else
    echo "Warning: vite.config.js not found"
fi

# Rename theme directory and maintain correct path
current_dir=${PWD##*/}
if [ "$current_dir" = "wpstarter" ]; then
    # First check if we have write permissions
    if [ ! -w ".." ]; then
        echo "Error: No write permissions in parent directory. Please run as administrator."
        exit 1
    fi

    # Check if target directory already exists
    if [ -d "../$theme_name_lower" ]; then
        echo "Error: Target directory $theme_name_lower already exists"
        exit 1
    fi

    # Try to rename with error handling
    if ! cd ..; then
        echo "Error: Could not change to parent directory"
        exit 1
    fi

    if ! mv -f "wpstarter" "$theme_name_lower"; then
        echo "Error: Could not rename directory. Please ensure you have proper permissions."
        exit 1
    fi

    if ! cd "$theme_name_lower"; then
        echo "Error: Could not change to new theme directory"
        exit 1
    fi

    echo "Renamed theme directory to $theme_name_lower"
fi

echo "Theme rename complete!"
echo "New theme name: $theme_name_title"
echo "Theme directory: $theme_name_lower"

# Run npm build
echo "Building theme assets..."
if command -v npm &> /dev/null; then
    if [ -f "package.json" ]; then
        npm install && npm run build
        if [ $? -eq 0 ]; then
            echo "Theme assets built successfully!"
        else
            echo "Error: Failed to build theme assets"
            exit 1
        fi
    else
        echo "Warning: package.json not found"
    fi
else
    echo "Warning: npm is not installed"
fi

# cd to project root
cd ../../..

site_url="https://${local_domain}"
wp_environment="development"
site_path="."

# Generate salts first
AUTH_KEY=$(openssl rand -base64 48 | tr -d '\n')
SECURE_AUTH_KEY=$(openssl rand -base64 48 | tr -d '\n')
LOGGED_IN_KEY=$(openssl rand -base64 48 | tr -d '\n')
NONCE_KEY=$(openssl rand -base64 48 | tr -d '\n')
AUTH_SALT=$(openssl rand -base64 48 | tr -d '\n')
SECURE_AUTH_SALT=$(openssl rand -base64 48 | tr -d '\n')
LOGGED_IN_SALT=$(openssl rand -base64 48 | tr -d '\n')
NONCE_SALT=$(openssl rand -base64 48 | tr -d '\n')

# create wp-config.php
echo "Generating wp-config.php..."
WP_CONFIG_CONTENT=$(cat <<EOF
<?php
/** Production wp-config.php generated by deployment script */

// ** Database settings ** //
define( 'DB_NAME', '$db_name' );
define( 'DB_USER', '$db_user' );
define( 'DB_PASSWORD', '$db_password' );
define( 'DB_HOST', '$db_host' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ** Authentication Unique Keys and Salts ** //
define( 'AUTH_KEY',         '$AUTH_KEY' );
define( 'SECURE_AUTH_KEY',  '$SECURE_AUTH_KEY' );
define( 'LOGGED_IN_KEY',    '$LOGGED_IN_KEY' );
define( 'NONCE_KEY',        '$NONCE_KEY' );
define( 'AUTH_SALT',        '$AUTH_SALT' );
define( 'SECURE_AUTH_SALT', '$SECURE_AUTH_SALT' );
define( 'LOGGED_IN_SALT',   '$LOGGED_IN_SALT' );
define( 'NONCE_SALT',       '$NONCE_SALT' );

// ** WordPress Database Table prefix ** //
\$table_prefix = 'wp_';

// ** WordPress debugging mode ** //
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );

// ** WordPress URLs ** //
define( 'WP_HOME', '$site_url' );
define( 'WP_SITEURL', '$site_url' );

// ** Memory settings ** //
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '256M' );

// ** Security settings ** //
define( 'DISALLOW_FILE_EDIT', true );
define( 'AUTOMATIC_UPDATER_DISABLED', true );

// ** Performance settings ** //
define( 'WP_CACHE', true );

// ** Custom Content Directory ** //
define( 'WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content' );
define( 'WP_CONTENT_URL', WP_HOME . '/wp-content' );

// ** Environment Type ** //
define( 'WP_ENVIRONMENT_TYPE', '$wp_environment' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
EOF
)

echo "$WP_CONFIG_CONTENT" > "wp-config.php"
echo "wp-config.php has been created successfully!"


# Remove existing .git if present, then initialize fresh git repo
if [ -d ".git" ]; then
    rm -rf .git
    echo "Removed existing .git directory"
fi

# rename the root folder
current_dir=${PWD##*/}
if [ "$current_dir" = "wpstarter" ]; then
    # First check if we have write permissions
    if [ ! -w ".." ]; then
        echo "Error: No write permissions in parent directory. Please run as administrator."
        exit 1
    fi

    # Check if target directory already exists
    if [ -d "../$theme_name_lower" ]; then
        echo "Error: Target directory $theme_name_lower already exists"
        exit 1
    fi

    # Try to rename with error handling
    if ! cd ..; then
        echo "Error: Could not change to parent directory"
        exit 1
    fi

    if ! mv -f "wpstarter" "$theme_name_lower"; then
        echo "Error: Could not rename directory. Please ensure you have proper permissions."
        exit 1
    fi

    if ! cd "$theme_name_lower"; then
        echo "Error: Could not change to new theme directory"
        exit 1
    fi

    echo "Renamed theme directory to $theme_name_lower"
fi

echo "Theme rename complete!"
echo "New theme name: $theme_name_title"
echo "Theme directory: $theme_name_lower"


# if theme name is not wpstarter, remove the install script
if [ "$theme_name_lower" != "wpstarter" ]; then
    rm install.sh
    echo "Removed install.sh for security reasons"
fi

echo
echo -e "\033[1;32m🎉 Setup complete! Your theme is ready to use."
echo -e "✨ You can now activate the theme in WordPress admin Panel.\033[0m"
echo


