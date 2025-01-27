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
4. Update the screenshot.png file in the theme directory with a screenshot of your theme. The image should be 1200x900 pixels and named `screenshot.png`. This image will be used as the theme preview in the WordPress admin panel.

5. Activate the theme in the WordPress admin panel.

6. Now you can cd into the updated theme directory. Start developing by running the following command:

```bash
npm run dev
```
Styles and script will compile on the fly. When you are done and ready for production run `npm run build` to compile optimized the styles and scripts for production.

### Happy coding!


