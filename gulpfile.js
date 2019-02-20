var gulp = require('gulp');
var pug = require('gulp-pug');
var data = require('gulp-data');
var prettyHtml = require('gulp-pretty-html');

gulp.task('pug', () => {
    return gulp.src(
            ['./_pug/**/*.pug', '!./_pug/**/_*.pug']
        )
        .pipe(data(function(file) {
            // metaのjsonファイルを取得
            var metaData = require('./_pug/data/meta.json');
            // 対象のファイルパスを取得して、\を/に置換
            var filePath = file.path.split('\\').join('/');
            // 必要なファイルパス部分のみ取得
            var fileName = filePath.split('_pug')[1].replace('.pug', '.html');
            // jsonファイルから対象ページの情報を取得して返す
            return metaData[fileName];
        }))
        .pipe(pug({
            pretty: true
        }))
        .pipe(prettyHtml({
            indent_size: 1,
            indent_char: '\t'
        }))
        .pipe(gulp.dest('./html/'));
});