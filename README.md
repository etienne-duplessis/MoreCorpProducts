#MoreCorpProducts


#### File Structure

```
/project root
    README.md <- you are here
    /public
        * Laravel public files.  
          - This is where the app is served from.
    /resources/assets
        * Theme assets, scripts and stylesheets
          - This is where the theme lives and where the assets are located.  
          - This is compiled via LaravelMix to the /public folder
```

## Installation Instructions for development environments

 * Pull down the repo into a local project directory: https://SkyFez@bitbucket.org/SkyFez/morecorpproducts.git
 * `cd` into the project directory
 * Run `npm install` from the command line to download all the dependencies
 * Run `php artisan serve` to start a local server for development. Open the link in your web browser http://127.0.0.1:8000
 * If you would like to work on the assets, run `npm run watch` and LaravelMix will automatically compile the assets and refresh the browser for you every time a change is detected
 * Setup a database (I use xampp). Edit your .env to align with the settings of your newly created database
 * Alternatively, run `cp .env.dev .env`. This will copy the .env.dev file to .env so that you have the same settings as the rest of your team
 * Run `php artisan migrate` to build the db data
 * Have fun!