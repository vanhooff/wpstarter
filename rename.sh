#!/bin/bash

# Function to convert string to lowercase
tolower() {
    echo "$1" | tr '[:upper:]' '[:lower:]'
}

# Function to convert string to uppercase
toupper() {
    echo "$1" | tr '[:lower:]' '[:upper:]'
}

# Function to convert string to title case
totitle() {
    echo "$1" | sed 's/.*/\L&/; s/[a-z]*/\u&/g'
}

# Ask for the new theme name
echo "Enter your theme name (e.g. My Awesome Theme):"
read theme_name

# Convert theme name to different formats
theme_name_lower=$(tolower "${theme_name// /-}")
theme_name_upper=$(toupper "${theme_name// /_}")
theme_name_title=$(totitle "$theme_name")
theme_name_pascal="${theme_name_title// /}"
theme_name_snake=$(tolower "${theme_name// /_}")

# Update style.css
if [ -f "style.css" ]; then
    # Create a temporary file
    tmp_file=$(mktemp)

    # Update the theme name in style.css while preserving the file structure
    sed "s/Theme Name:         WPStarter/Theme Name:         ${theme_name_title}/" style.css > "$tmp_file"
    sed -i "s/Description:        WPStarter/Description:        ${theme_name_title}/" "$tmp_file"

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
