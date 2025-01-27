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
echo "Enter your theme name (e.g. My Awesome Theme):"
read theme_name

# Ask for the author name
echo "Enter author name (e.g. Online Klik B.V.):"
read author_name

# Ask for the theme URI
echo "Enter developer URI (e.g. https://www.onlineklik.nl):"
read theme_uri

# Ask for the local development URL
echo "Enter your local development URL (e.g. https://wpstarter.test):"
read dev_url

# Convert theme name to different formats
theme_name_lower=$(tolower "${theme_name// /-}")
theme_name_upper=$(toupper "${theme_name// /_}")
theme_name_title="$theme_name"
theme_name_pascal="${theme_name_title// /}"
theme_name_snake=$(tolower "${theme_name// /_}")

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
Requires PHP:       8.1
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

# Update bud.config.js
if [ -f "bud.config.js" ]; then
    # Create a temporary file
    tmp_file=$(mktemp)

    # Replace both the public path and proxy URL in bud.config.js
    sed -e "s|app.setPublicPath('/app/themes/sage/public/')|app.setPublicPath('/app/themes/${theme_name_lower}/public/')|g" \
        -e "s|.setProxyUrl('http://example.test')|.setProxyUrl('${dev_url}')|g" \
        bud.config.js > "$tmp_file"

    # Move the temporary file back to bud.config.js
    mv "$tmp_file" bud.config.js
    echo "Updated bud.config.js public path and proxy URL"
else
    echo "Warning: bud.config.js not found"
fi

# Rename theme directory and maintain correct path
current_dir=${PWD##*/}
if [ "$current_dir" = "wpstarter" ]; then
    cd ..
    mv wpstarter "$theme_name_lower"
    cd "$theme_name_lower"
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

# if theme name is not wpstarter, remove the install script
if [ "$theme_name_lower" != "wpstarter" ]; then
    rm install.sh
    echo "Removed install.sh for security reasons"
fi

echo "Setup complete! Your theme is ready to use."

