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

# Files to update
files_to_update=(
    "style.css"
)

# Perform replacements
echo "Updating theme files..."

for file in "${files_to_update[@]}"; do
    if [ -f "$file" ]; then
        sed -i "s/WPStarter/${theme_name_pascal}/g" "$file"
        sed -i "s/wpstarter/${theme_name_lower}/g" "$file"
        sed -i "s/WPSTARTER/${theme_name_upper}/g" "$file"
        echo "Updated $file"
    else
        echo "Warning: $file not found"
    fi
done

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
