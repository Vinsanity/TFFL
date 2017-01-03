#Rudiments
===
A responsive WordPress starter theme for advanced WordPress theme developers.

Rudiments was built to be a starter theme (not a framework) that utilizes current and stable development technologies for constructing flexible WordPress themes. It was built to meet the needs of 3five as an agency but we welcome you to find a use for it as well. If you can contribute to it and improve it, even better!

## Requirements
---
- **Advanced WordPress theme development knowledge**
- **Knowledge of SCSS mixins**
- **A preprocessor and task-runner for SCSS and JS**: We use Gulp and gulp-sass but you can also use Grunt, CodeKit, or PrePros. CodeKit and PrePros are standalone programs while Grunt and Gulp require a manual setup and some node and ruby gem dependencies to compile, concatenate and minify the js the scss files.

## Getting Started
---
1. Place the rudiments folder in your WordPress theme directory.
2. Compile the master.scss file to the assets/dist/css directory as master.css.
3. Compile the js files in the scripts folder to the assets/dist/js directory as scripts.js
4. Rename the theme and other options in the style.css file in the root directory.
5. In the WordPress admin panel activate the theme under Appearance -> Themes.

## Concepts
---
1. Compile all you assets (images, js, scss and fonts) into their respective folders in the assets/dist folder. This includes concatenating or compiling scripts and css, compressing and reducing file sizes of images and fonts.
2. Modularize your markup for your templates. This creates reusable blocks of code that can be called in an unlimited number of places.
3. Whenever possible, create actions and filters that call your function(s). This keeps your queries and PHP code out of your markup making it easier to read and understand your templates.
4. Try to follow the [WordPress coding standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/#language-specific-standards).

## Features
---
###PHP Features
**[Mobile Detect library](http://mobiledetect.net).**
You can use the predefined object of `$mobile_detect` and call it as a global on any of your theme pages to define a specific code snippet to run.

### SCSS Features
#### @Mixins
**Media Queries**
`@mixin mq($breakpoint, $width: true, $min: true)`
Usage: `@include mq(480);`
@vars:
\$breakpoint - The breakpoint in pixels. Uses the rem_calc() function to calculate the min-# or max-# value.
\$width - If true, this mq is triggered by width. If false, it will be triggered by height. Default: true.
\$min - If true, this min-(width/height) mq, If false, it will be a max-(width/height) mq. Default true

** Grid System **
Rows
`@mixin grid-row($behavior: false, $no-columns: false, $gutter: false)`
Usage: `@include grid-row();`
@vars:
\$behavior - Row behavior. Default: false. Options: nest, collapse, nest-collapse, false
\$no-columns - Does this row have columns? Default: false. Options: true, false.
\$gutter - Need to adjust the $column-gutter? Update here. Default: false. Options: value (px), false.

Columns
`@mixin grid-column( $columns: false, $last-column: false, $center: false, $offset: false, $push: false, $pull: false, $collapse: false, $float: true, $position: false, $gutter: false)`
Usage: `@include grid-row(6);` or `@include grid-column(6.25, $collapse: true, $push .75);` or `@include grid-column(6.25, $gutter: 80, $float: 'inline');`
@vars:
\$columns - The number of columns this should be
\$last-column - Is this the last column? Default: false.
\$center - Center these columns? Default: false.
\$offset - # of columns to offset. Default: false.
\$push - # of columns to push. Default: false.
\$pull - # of columns to pull. Default: false.
\$collapse - Get rid of gutter padding on column? Default: false.
\$float - Should this float, inline-block, or none? Default: true. Options: true, false, inline, left, right.
\$gutter - Need to adjust the $column-gutter? Update here. Default: false. Options: value (px), false.

** CSS Transforms **
`@mixin transition($properties)`
Usage: `@include transition('opacity .25s ease');`

`@mixin transform($properties)`
Usage: `@include transform( 'translate3d(-50%, -50%, 0)' );`

** Animations **
@mixin keyframe ($animation_name)
Usage: `@include keyframe('animate-object') {
	0%   {background-color: red;}
    25%  {background-color: yellow;}
    50%  {background-color: blue;}
    100% {background-color: green;}
}`

@mixin animation($properties)
Usage: `@include animation('animate-object 4s infinite');`

** Misc **
`@mixin flexbox()`
Usage: `@include flexbox();`

@mixin flex($values)
Usage: `@include flexbox('1 1 auto');`

### Folder Structure
We approached the hierarchy of the folder system for the theme with one idea in mind, "keep your code modular".

Initially, it may seem that there are too many folders and this would make it more confusing. For 3five we've found this to be the opposite. By modularizing these smaller bits of code we can utilize more WordPress hooks and actions to pull these pieces of code and structure into multiple areas of the theme much easier and in turn giving us one place to make a change that will update everywhere.

Before modifying the folder structure, make sure you've updated your task-runner files accordingly and modify the functions.php file and base/rudiments.php file to reflect your changes as needed.

Cheers!

---
Make something great! Then share it.
3five
