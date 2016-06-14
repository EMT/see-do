var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	// Concatenate and output to public/css/app.css
    mix.sass('app.scss');

    // Concatenate and output to public/js/all.js
    mix.scripts([
        'vendor/jquery.min.js',
	    'vendor/velocity.js',
	    'vendor/velocity-ui.js',
	    'vendor/smartresize.js',
	    'vendor/fastclick.js',
        'vendor/moment.js',
	    'vendor/chrono.min.js',
        'stateHandler.js',
	    'animation.js',
	    'bootstrap.js',
        'forms.js',
        'color-scheme-select.js',
        'icon-select.js',
	    'date-time-input.js'
	],
	'public/js/all.js'
	)
	.scripts([
        'vendor/jquery.min.js',
		'poly-decomp.js',
		'matter.js',
	    'home-background.js'
	],
	'public/js/homepage.js'
	);

    // Rename with hash and save into dir: public/build
	mix.version([
		'css/app.css',
		'js/all.js',
		'js/homepage.js'
	]);
});


