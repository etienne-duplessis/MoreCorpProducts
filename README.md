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

 * Pull down the repo into a local project directory: `https://github.com/etienne-duplessis/MoreCorpProducts.git
`
 * `cd` into the project directory
 * Run `npm install` from the command line to download all the dependencies
 * Run `php artisan serve` to start a local server for development. Open the link in your web browser http://127.0.0.1:8000
 * If you would like to work on the assets, run `npm run watch` and LaravelMix will automatically compile the assets and refresh the browser for you every time a change is detected
 * Setup a database (I use xampp). Edit your .env to align with the settings of your newly created database
 * Alternatively, run `cp .env.dev .env`. This will copy the .env.dev file to .env so that you have the same settings as the rest of your team. Be sure to setup your db accordingly.
 * Run `php artisan migrate` to build the db data
 
 ## Testing instructions - Admin area
 
 * Run `php artisan db:seed` to seed the test data.
 * Please note. A couple of test users, products and bids have been seeded. ONLY ONE admin user has ben created that you can use to access the admin area. The email address is `admin@admin.com` and the password is `admin`.
 * Only the admin user can access the admin area `http://127.0.0.1:8000/admin`. Normal users will be redirected back to the public site.
 * On first access - you will be asked to login with the admin credentials - and will then be redirected to the products index page.
 
 ## Testing instructions - Public area

 * If you haven't done so already, run `php artisan db:seed` to seed the test data.
 * Please note. A couple of test users, products and bids have been seeded.
 * A guest or logged in 'normal' user can access the public site at `http://127.0.0.1:8000`. Here you will see the product index page.
 * As requested, you can view a product and then place a bid.
 * If a bid is placed with an email that doesn't exist, the single bid will be created, a user will be created and the user automatically logged in.
 * Now that user can place more bids without having to supply an email address. He/she can also bid on other products, but only once.
 * You can also log the user out to try and create a new one. Any logged in users will be able to see their existing bids etc.
 