var gulp = require('gulp');
var browserSync = require('browser-sync');
var reload = browserSync.reload;


gulp.task('watch', function(){
  browserSync({
    host: "localhost",
    notify: false,
  });
  gulp.watch('assets/css/*.css', function(done) {
    browserSync.reload();
    done();
  }); 
  gulp.watch('**/*.php', function(done) {
    browserSync.reload();
    done();
  });
  gulp.watch('**/*.js', function(done) {
    browserSync.reload();
    done();
  });
})