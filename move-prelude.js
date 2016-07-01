var source = fs.createReadStream('./src/**/*');
var dest = fs.createWriteStream('../');

source.pipe(dest);
source.on('end', function() {
  console.log('[Prelude]: Files successfully moved. Go make rad stuff!');
});
source.on('error', function(err) {
  console.log('[Prelude]: Move of Prelude files failed.');
});
