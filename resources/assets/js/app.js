
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

(function(){

    /**
     * THE MAIN SCRIPT CONSTRUCTOR
     */

    function scriptConstructor(){
        console.log('DOM is ready');

        /**
         * Load feather icons
         */

        feather.replace();

        /**
         * Fade out alert after a couple of seconds
         */

        setTimeout(function() {
            $('#flash-message').fadeOut('slow');
        }, 8000 );

        /**
         * Add active classes for bootstrap nav
         */

        var url = window.location.pathname;
        // alert(url);
        $('ul.nav a[href="'+ url +'"]').addClass('active');
        // $('ul.nav a').filter(function() {
        //     return this.href == url;
        // }).addClass('active');
    }

    $(window).ready(scriptConstructor);

    /**
     * THE CODE TO LOAD ONLY WHEN PAGE HAS FULLY LOADED
     */

    var interval = setInterval(function() {
        'use strict';
        if(document.readyState === 'complete') {
            clearInterval(interval);
            console.log('Page has finished loading');
        }
    }, 100);
})();