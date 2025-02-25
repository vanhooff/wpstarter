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

# Ask for the local development URL
echo "Enter local development domain (press Enter for '${theme_name_lower}.test'):"
read local_domain
local_domain="${local_domain:-${theme_name_lower}.test}"


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

# Remove existing .git if present, then initialize fresh git repo
if [ -d ".git" ]; then
    rm -rf .git
    echo "Removed existing .git directory"
fi

#git init
#git add .
#git commit -m "Initial commit"
#echo "Initialized new git repository with initial commit"


# Remove default WordPress themes except the latest
echo "Removing default WordPress themes..."
cd ..
# Get the highest numbered theme using numeric comparison
latest_theme=$(ls -d twenty* | while read theme; do
    num=$(echo "$theme" | sed -E 's/twenty(twenty)?//' | sed 's/three/3/;s/four/4/;s/five/5/;s/six/6/;s/seven/7/;s/eight/8/;s/nine/9/')
    echo "$num:$theme"
done | sort -t: -k1,1n | tail -n1 | cut -d: -f2)

# Remove all twenty* themes except the latest
for theme in twenty*; do
    if [ "$theme" != "$latest_theme" ]; then
        rm -rf "$theme"
        echo "Removed $theme"
    fi
done
cd "$theme_name_lower"
echo "Kept $latest_theme as fallback theme"


# if theme name is not wpstarter, remove the install script
if [ "$theme_name_lower" != "wpstarter" ]; then
    rm install.sh
    echo "Removed install.sh for security reasons"
fi

echo
echo -e "\033[1;32m🎉 Setup complete! Your theme is ready to use."
echo -e "✨ You can now activate the theme in WordPress admin Panel.\033[0m"
echo


