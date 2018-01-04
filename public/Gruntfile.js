module.exports = function(grunt) {
  'use strict';
  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),
    // RequireJS Task
    // -------------------------------------------------------------------------
    requirejs: {
      compile: {
        options: {
          name: '../libs/require',
          include: ['init'],
          optimize: 'uglify',
          baseUrl: 'js/app',
          mainConfigFile: 'js/app/config.js',
          out: 'js/main-built.js',
          inlineText: true,
          findNestedDependencies: true,
          locale: 'en_us',
          preserveLicenseComments: false
        }
      }
    },
    // JsHint Task
    // -------------------------------------------------------------------------
    jshint: {
      files: [
        'Gruntfile.js',
        'js/app/**/*.js',
        '!js/app/**/*min.js'
      ],
      options: grunt.file.readJSON('jshintrc.json')
    },
    // Compass Tasks
    // -------------------------------------------------------------------------
    compass: {
      production: {
        options: {
          require: [
            'rubygems',
            'bundler/setup',
            'breakpoint',
            'sass-globbing'
          ],
          relativeAssets: true,
          sassDir: 'css/src',
          cssDir: 'css',
          fontsDir: 'fonts',
          httpFontsPath: 'fonts',
          imagesDir: 'img',
          httpImagesPath: 'img',
          quiet: true,
          outputStyle: 'compressed',
          force: true
        }
      },
      development: {
        options: {
          require: [
            'rubygems',
            'bundler/setup',
            'breakpoint',
            'sass-globbing'
          ],
          relativeAssets: true,
          sassDir: 'css/src',
          cssDir: 'css',
          fontsDir: 'fonts',
          httpFontsPath: 'fonts',
          imagesDir: 'img',
          httpImagesPath: 'img',
          outputStyle: 'nested',
          force: true
        }
      }
    },
    // Watch Task
    // -------------------------------------------------------------------------
    watch: {
      styles: {
        files: [
          'css/src/**/*.scss',
          'js/app/**/*.js'
        ],
        tasks: ['test', 'compass:development'],
        options: {
          spawn: false
        }
      },
      svgs: {
        files: 'img/svg/**/*.svg',
        tasks: ['svg']
      }
    },
    // SVG Store: Spriting
    // -------------------------------------------------------------------------
    svgstore: {
      options: {
        //cleanup: true,
        prefix : 'svg-',
        svg: {
          id: 'svg-defs',
          class: 'svg-hide',
          xmlns: 'http://www.w3.org/2000/svg'
        }
      },
      build: {
        files: {
          'img/svg/built/svg-defs.svg': ['img/svg/*.svg']
        }
      }
    },
    // Remove Console Logging
    // -------------------------------------------------------------------------
    removelogging: {
      dist: {
        src: 'js/app/**/*.js'
      }
    }
  });

  grunt.loadNpmTasks("grunt-remove-logging");
  grunt.loadNpmTasks('grunt-contrib-requirejs');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-svgstore');
  grunt.registerTask('svg', ['svgstore']);
  grunt.registerTask('test', ['jshint']);
  grunt.registerTask('default', ['test', 'svg', 'compass:development']);
  grunt.registerTask('build', [ 'test', 'requirejs', 'svg', 'compass:production']);
};
