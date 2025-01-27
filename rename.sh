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
echo "Enter author name:"
read author_name

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
Theme URI:          https://roots.io/sage/
Description:        ${theme_name_title} is a WordPress theme.
Version:            1.0.0
Author:             ${author_name}
Author URI:         https://roots.io/
Text Domain:        sage
License:            MIT License
License URI:        https://opensource.org/licenses/MIT
Requires PHP:       8.1
Requires at least:  5.9
*/
EOF

    # Move the temporary file back to style.css
    mv "$tmp_file" style.css
    echo "Updated style.css"
else
    echo "Warning: style.css not found"
fi

# Rename theme directory
current_dir=${PWD##*/}
if [ "$current_dir" = "wpstarter" ]; then
    cd ..
    mv wpstarter "$theme_name_lower"
    echo "Renamed theme directory to $theme_name_lower"
fi

echo "Theme rename complete!"
echo "New theme name: $theme_name_title"
echo "Theme directory: $theme_name_lower"
