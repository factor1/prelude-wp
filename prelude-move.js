var  ncp     = require('ncp').ncp,
    source   = './src/',
destination  = '../';


ncp.limit = 16;


ncp(source, destination, function (err) {
 if (err) {
   return console.error(err);
 }
 console.log('[Prelude]: Files copied to project directory.');
});
