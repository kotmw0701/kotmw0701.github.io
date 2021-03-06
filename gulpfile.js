const fs = require('fs');
const gulp = require('gulp');
const pug = require('gulp-pug');
const data = require('gulp-data');
const prettyHtml = require('gulp-pretty-html');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');

gulp.task('pug', () => {
	return gulp.src(
		['./_pug/**/*.pug', '!./_pug/**/_*.pug']
	)
		.pipe(data((file) => {
			// metaのjsonファイルを取得 requireでも良かったけどそうするとキャッシュが残っちゃうからJson.parseで
			let metaData = JSON.parse(fs.readFileSync('./_pug/data/meta.json', 'utf8', (err, data) => {
				if (err) throw err;
				console.log(data);
			}));
			// 対象のファイルパスを取得して、\を/に置換
			let filePath = file.path.split('\\').join('/');
			// 必要なファイルパス部分のみ取得
			let fileName = filePath.split('_pug')[1].replace('.pug', '.html');
			// jsonファイルから対象ページの情報を取得して返す
			let global = metaData["global"];//全体の共通データを取得
			let meta = metaData[fileName];//変更点のデータを取得
			//css,jsのパスを指定するためrootまでの相対パスを生成
			for (let i = 0; i < fileName.slice(1).split("/").length - 1; i++) {
				global["root"] += "../";
			}
			//テンプレートとの変更点を変更する
			Object.keys(meta).forEach(function (key) {
				global[key] = this[key];
			}, meta);

			return global;
		}))
		.pipe(pug())
		.pipe(prettyHtml({
			indent_size: 1,
			indent_char: '\t'
		}))
		.pipe(gulp.dest('./'));
});

gulp.task('css', () => {
	return gulp.src("./stylesheets/*.css")
		.pipe(postcss([
			autoprefixer({
				// ☆IEは11以上、Androidは4.4以上
				// その他は最新2バージョンで必要なベンダープレフィックスを付与する設定
				browsers: ["last 2 versions", "ie >= 11", "Android >= 4"],
				cascade: false
			})
		]))
		.pipe(gulp.dest("./stylesheets"))
});