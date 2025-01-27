# WPStarter
WPStarter is a WordPress theme that is designed to be a starting point for new WordPress projects. It is based on the [Sage](https://roots.io/sage/) theme by [Roots](https://roots.io/).

## Getting started
1. Make sure you have a Wordpress installation ready with connected DB.
2. Clone this repository into the `wp-content/themes` directory of your WordPress installation. You can do this by running the following command in your terminal:

```bash
cd /path/to/your/wordpress/installation/wp-content/themes
git clone https://github.com/vanhooff/wpstarter.git
```

3. Install the required dependencies by running the following commands in the theme directory:

Change directory to the theme directory:
```bash
cd wpstarter
```
Install composer dependencies:
```bash
composer install
```
Install npm dependencies. You can also use yarn if you prefer.
```bash
npm install
```

Run the script to change the naming of the theme to your theme name:
```bash
# Make the script executable
chmod +x rename.sh
# Run the script
./rename.sh
```

5. Activate the theme in the WordPress admin panel.
