Development Setup
-----------------

Install node js on your system.
Then run `npm install` in `public` install required node packages



## Bundler

**Have RVM and Ruby installed.**

- Install Bundler Gem: `gem install bundler`

- Run the following commands in `public`

- Install Project Gem Dependencies: `bundle install`

- Update Project Gem Dependencies: `bundle update`


## Common Grunt Tasks

Prefix all tasks with `bundle exec`. Run Grunt commands in `public`

- Watch for js/scss/svg file changes: `bundle exec grunt watch`

- Compile only compass for dev: `bundle exec grunt compass:development`

- Lint with jshint: `bundle exec grunt test`

- Compile for production: `bundle exec grunt build`
