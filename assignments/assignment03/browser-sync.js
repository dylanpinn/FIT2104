'use strict';

const serve = require('browser-sync');
const proxy = require('http-proxy-middleware');
const bundler = require('./bundler');

// browser sync settings
serve({
    port: 3000,
    open: false,
    server: {
        baseDir: './webroot'
    },
    middleware: [
        proxy('http://localhost:80', {}),
        bundler.middleware()
    ]
});
