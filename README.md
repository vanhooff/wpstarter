# WPStarter

WPStarter is a WordPress theme that is designed to be a starting point for new WordPress projects. It is based on the [Sage](https://roots.io/sage/) theme by [Roots](https://roots.io/).

## Table of Contents

- [Getting Started](#getting-started)
- [Core Concepts](#core-concepts)
  - [Theme Architecture](#theme-architecture)
  - [Component Architecture](#component-architecture-using-laravel-blade-template-engine)
    - [Component Views](#1-component-views-resourcesviewscomponents)
    - [Component Logic](#2-component-logic-appviewcomponents)
  - [Sage Directives](#sage-directives)
  - [Creating ACF Block Components](#creating-components-for-acf-blocks)
  - [Creating General Components](#creating-general-components-via-cli)

- [Styles and Scripts](#styles-and-scripts)
  - [Directory Structure](#directory-structure)
  - [Styling with Tailwind CSS](#styling-with-tailwind-css)
    - [Why Tailwind CSS](#why-tailwind-css)
    - [Using Tailwind](#1-using-tailwind)
  - [Using Alpine.js](#using-alpinejs)
    - [Simplicity & Learning Curve](#1-simplicity--learning-curve)
    - [Component Functionality](#2-component-functionality)
    - [WordPress Integration Benefits](#3-wordpress-integration-benefits)
    - [Simple Example](#4-simple-example)

## ⚠️ Prerequisites
**This project and especially the installation script will require MacOS, using Windows will not work.**

## Getting started

1. Make sure you have created a new DB and have the credentials ready. Navigate into your Projects/Herd folder and clone this repository.

```bash
cd /path/to/your/projects-folder
```

```bash
git clone https://github.com/vanhooff/wpstarter.git
```

2. Navigate into the newly cloned repository.

```bash
cd wpstarter
```

4. Run the installation script:

```bash
chmod +x install.sh
./install.sh
```

5. After the installation has finished cd out of the now renamed project folder.

```bash
cd ..
```

6. Then navigate to the newly created theme directory. The project folder and the theme folder will have the same name.

```bash
cd your-new-project-name/wp-content/themes/your-new-theme-name
```

7. Open your browser and navigate to https://your-new-project-name.test and finish the installation of WordPress.
8. Activate ACF PRO and then activate the theme in the WordPress admin panel.
9. Update the screenshot.png file in the theme directory with a screenshot of your theme. The image should be 1200x900 pixels and named `screenshot.png`. This image will be used as the theme preview in the WordPress admin panel.
10. Return to your terminal and run the command below in your theme directory to start developing.

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

<x-button type="primary" label="Click Me"/>
```

### Sage Directives

This starterkit also includes the Sage Directives package, which adds a variety of useful Blade directives for use with Sage 10 including directives for WordPress, ACF, and various miscellaneous helpers.

More info about Sage Directives can be found here;

- [Wordpress directives &rarr;](https://log1x.github.io/sage-directives-docs/usage/wordpress.html)
- [ACF directives &rarr;](https://log1x.github.io/sage-directives-docs/usage/acf.html)

### Creating components for ACF Blocks

1. Each ACF block component requires its own directory within the blocks folder (this is the way we automatically detect it and register it), named identically to the component itself.

For example, to create a block called `example-block`, you would create the following file:

```
resources/views/blocks/example-block/example-block.blade.php
```

To complete the block, place an SVG icon that represents the component in the same view directory with the name of the component. In this case:

```
resources/views/blocks/example-block/example-block.svg
```

A good source for a variety of SVG icons is [https://blade-ui-kit.com/blade-icons](https://blade-ui-kit.com/blade-icons).

2. Next create an ACF field group with the block name and add the fields you want to use for the block. Below the fields, under tab location rules: Show this field group if: Block is equal to `Example Block`.
3. All the field data is available in the block component view file. e.g.:

```php
  $image = get_field('image');
  $title = get_field('title');
```

### Creating general components via CLI

To create a new component the easy way just run this command in the theme directory:

```bash
# In the root components directory
wp acorn make:component ExampleComponent

# In a subdirectory
wp acorn make:component Example/ExampleComponent
```

## Styles and Scripts

### Directory Structure

```
├── resources/ 
│ ├── js/ 
│ │ ├── app.js # Main JavaScript entry point 
│ │ └── editor.js # Gutenberg-specific JavaScript entry point
│ └── css/ 
│ ├── app.css # Tailwind configuration and Main CSS entry point
│ ├── editor.css # Gutenberg-specific CSS entry point
```

### Styling with Tailwind CSS

Totally optional but extremely highly recommended. This theme comes with Tailwind CSS pre-configured.

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

### 1. Using Tailwind

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
