/**
 * This file contains all the gulp tasks needed to create a production and archive build for the theme.
 */
'use strict';

// Require all the necessary modules.
let gulp         = require( 'gulp' ),
    sass         = require( 'gulp-sass' ),
    lec          = require ( 'gulp-line-ending-corrector' ),
    sourcemaps   = require( 'gulp-sourcemaps' ),
    autoprefixer = require( 'gulp-autoprefixer' ),
    cleanCSS     = require( 'gulp-clean-css' ),
    rename       = require( 'gulp-rename' ),
    concat       = require( 'gulp-concat' ),
    pump         = require( 'pump' ),
    uglify       = require( 'gulp-uglify-es' ).default,
    del          = require( 'del' );


// Compile the main Sass file into expanded CSS main stylesheet
gulp.task( 'compileMainStylesheet',  () => {
    return gulp.src( './sass/style.scss' )
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(lec({eolc: 'CRLF'}))
        .pipe(gulp.dest('./'));
});

// Compile the color scheme Sass files into expanded CSS colo scheme files
gulp.task('compileColorSchemes', () => {
    return gulp.src('./sass/color-schemes/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(lec({eolc: 'CRLF'}))
        .pipe(gulp.dest('./css/'));
});

// Compile the editor styles Sass file into CSS
gulp.task('compileEditorStyles',  () => {
    return gulp.src('./sass/editor-style.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(lec({eolc: 'CRLF'}))
        .pipe(gulp.dest('./'));
});


// Auto-prefix the main stylesheet.
gulp.task('prefixMainStylesheet', ['compileMainStylesheet'], () => {
    return gulp.src('./style.css')
        .pipe(autoprefixer({
            browsers: ['last 3 versions'],
            cascade: false
        }))        
        .pipe(gulp.dest('./'));
});

// Auto-prefix the color scheme stylesheet.
gulp.task('prefixColorSchemes', ['compileColorSchemes'], () => {
    return gulp.src('./css/*.css')
        .pipe(autoprefixer({
            browsers: ['last 3 versions'],
            cascade: false
        }))        
        .pipe(gulp.dest('./css/'));
});

// Auto-prefix the edito styles.
gulp.task('prefixEditorStyles', ['compileEditorStyles'], () => {
    return gulp.src('./editor-style.css')
        .pipe(autoprefixer({
            browsers: ['last 3 versions'],
            cascade: false
        }))        
        .pipe(gulp.dest('./'));
});


// Minify the main stylesheet
gulp.task('minifyMainStylesheet', ['prefixMainStylesheet'], () => {
    return gulp.src('./style.css')
        .pipe(cleanCSS({compatibility: '*'}))
        .pipe(rename('./style.min.css'))
        .pipe(gulp.dest('./'));
});

// Minify the color schemes stylesheets.
gulp.task('minifyColorSchemes', ['prefixColorSchemes'], () => {
    return gulp.src('./css/*.css')
        .pipe(cleanCSS({compatibility: '*'}))
        .pipe(rename({
            suffix: ".min",
        }))
        .pipe(gulp.dest('./css/'));
});

// Minify the editor styles stylesheet.
gulp.task('minifyEditorStyles', ['prefixEditorStyles'], () => {
    return gulp.src('./editor-style.css')
        .pipe(cleanCSS({compatibility: '*'}))
        .pipe(rename({
            suffix: ".min",
        }))
        .pipe(gulp.dest('./'));
});


// Concatenate and minify the main JavaScript files
gulp.task('minifyMainScripts', () => {
    return gulp.src(['js/detection.js', 'js/skip-link-focus-fix.js', 'js/navigation.js'])
        .pipe(concat('main-scripts.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('js/'));
});

// Minify the customizer script
gulp.task('minifyCustomizerScript', () => {
    return gulp.src('js/customizer.js')
        .pipe(uglify())
        .pipe(rename({
            suffix: '.min',
        }))
        .pipe(gulp.dest('js/'));
});


// Task to clean CSS files, JS files and theme folder.
gulp.task('clean', function(){
     return del([ 'css', '*.css', 'js/*.min.js', 'carbon-lite', 'carbon-lite-archive']);
});


// Main Build task. Build the theme for production
gulp.task('build', ['minifyMainStylesheet', 'minifyColorSchemes', 'minifyEditorStyles', 'minifyMainScripts', 'minifyCustomizerScript'], function(){
    return gulp.src([
            'css/**',
            'icons/**',
            'inc/**',
            'js/**',
            'languages/**',
            'template-parts/**',
            '*.php',
            'LICENSE',
            'readme.txt',
            'screenshot.png',
            '*.css',
        ], {base: './'})
           .pipe(gulp.dest('./carbon-lite'));
});

// Archive Build task. Build the theme for archiving
gulp.task('archive', ['build'], function(){
    return gulp.src([
            'css/**',
            'icons/**',
            'inc/**',
            'js/**',
            'languages/**',
            'prototype/**',
            'sass/**',
            'template-parts/**',
            '.jscsrc',
            '.sjhintignore',
            '*.php',
            'gulpfile.js',
            'LICENSE',
            'package.json',
            'readme.txt',
            'screenshot.png',
            '*.css',
        ], {base: './'})
           .pipe(gulp.dest('./carbon-lite-archive'));
});


// Default task
gulp.task('default', ['clean'], function(){
    gulp.start('archive');
})