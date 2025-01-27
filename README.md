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
chmod +x install.sh
```
```bash
# Run the script
./install.sh
```

4. Update the screenshot.png file in the theme directory with a screenshot of your theme. The image should be 1200x900 pixels and named `screenshot.png`. This image will be used as the theme preview in the WordPress admin panel.

5. Activate the theme in the WordPress admin panel.

6. Now you can cd into the updated theme directory. Start developing by running the following command:

```bash
npm run dev
```
Styles and script will compile on the fly. When you are done and ready for production run `npm run build` to compile optimized the styles and scripts for production.

**Do not edit the styles and script in the public folder directly. They will be overwritten when you run `npm run build`.**

### Happy coding!

---

## Core Concepts

### Theme Architecture

As mentioned before, this theme is based on the Sage theme by Roots. The documentation for Sage can be found [here](https://roots.io/sage/docs/).

### Component Architecture using Laravel Blade template engine

This theme uses the [Blade](https://laravel.com/docs/blade) templating engine with a two-part component structure:

#### 1. Component Views (`resources/views/components`)
Contains the Blade template files that define how components look. These are the actual HTML/PHP templates that render your components.

#### 2. Component Logic (`app/View/Components`)
Contains the PHP classes that handle the component's functionality, data processing, and business logic.

#### How it works

For example, if you have a button component:

```php
// app/View/Components/Button.php
namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $label;

    public function __construct($type = 'primary', $label = '')
    {
        $this->type = $type;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.button');
    }
}
```

```html
<!-- resources/views/components/button.blade.php -->
<button class="btn btn-{{ $type }}">
    {{ $label }}
</button>
```

Then you can use the button component in your Blade templates like this:

```html
<x-button type="primary" label="Click Me" />
```

## Styles and Scripts

### Directory Structure

```
├── resources/ 
│ ├── scripts/ 
│ │ ├── app.js # Main JavaScript entry point 
│ │ └── editor.js # Gutenberg-specific JavaScript entry point
│ └── styles/ 
│ ├── app.css # Main CSS entry point 
│ ├── editor.css # Gutenberg-specific CSS entry point
```

### Styling with Tailwind CSS

Totally optional but extremely highly recommended. This theme comes with Tailwind CSS pre-configured. The main configuration file is `tailwind.config.js` in the root directory. Here you can rapidly create design systems, color palettes, and custom styles for your theme.

### Why Tailwind CSS?

Tailwind CSS is a utility-first CSS framework that offers several significant advantages for WordPress theme development:

#### 1. Development Speed
- **Rapid Prototyping**: Build custom designs quickly without writing CSS from scratch
- **No Context Switching**: Write styles directly in your HTML/Blade templates
- **Predictable Results**: Classes behave the same way everywhere they're used

#### 2. Maintainability
- **No CSS Specificity Wars**: Avoid cascading style conflicts
- **Consistent Naming**: No more struggling with BEM or other naming conventions
- **Smaller CSS Bundle**: Only includes the styles you actually use
- **Easy Updates**: Modify styles directly in templates without hunting through CSS files

#### 3. Customization
- **Highly Configurable**: Easy to customize colors, spacing, breakpoints, etc.
```js
// tailwind.config.js
module.exports = {
    theme: {
        extend: {
            colors: {
                primary: '#FF0000',
                secondary: '#00FF00',
            },
        },
    },
}
```

#### 1. Using Tailwind

```html
<!-- Example component using Tailwind classes -->
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold mb-4">Title</h2>
    <p class="text-gray-600">Content</p>
</div>
```

More information on Tailwind CSS can be found [here](https://tailwindcss.com).

### Using Alpine.js

Totally optional but extremely highly recommended. This theme comes with Alpine.js pre-configured. Alpine.js is a minimal framework for composing JavaScript behavior in your HTML templates. It offers several significant advantages for WordPress theme development:

#### 1. Simplicity & Learning Curve
- **Minimal Syntax**: Similar to Vue.js but lighter and simpler
- **HTML-First**: Write JavaScript behavior directly in your HTML
- **No Build Step Required**: Works directly in the browser
- **Small Size**: Only ~7kb gzipped

#### 2. Component Functionality
- **Declarative Data Binding**: Easily bind data to elements
```html
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
    <div x-show="open">Content</div>
</div>
```
- **State Management**: Handle component state without complex setup
- **Event Handling**: Simple event listeners and responses

#### 3. WordPress Integration Benefits
- **No Framework Lock-in**: Works alongside any other JavaScript
- **Gutenberg Compatible**: Perfect for enhancing blocks
- **Progressive Enhancement**: Add interactivity without breaking basic functionality

#### 4. Simple example

Dropdown menu:
```html
<div x-data="{ open: false }">
    <button @click="open = !open">Menu</button>
    <ul x-show="open" @click.away="open = false">
        <li>Item 1</li>
        <li>Item 2</li>
    </ul>
</div>
```
More information on Alpine.js can be found [here](https://alpinejs.dev).
