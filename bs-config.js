require( 'dotenv' ).config();
const port = process.env.WP_PORT;
const theme = process.env.WP_THEME;
module.exports = {
	proxy: `localhost:${ port }`,
	files: [
		'./htdocs/wp-content/mu-plugins/blocks/build/**/*.*',
		`./htdocs/wp-content/mu-plugins/blocks/**/*.{jpg,jpeg,gif,png,svg,php}`,
		`./htdocs/wp-content/themes/${ theme }/build/**/*.*`,
		`./htdocs/wp-content/themes/${ theme }/**/*.{jpg,jpeg,gif,png,svg,php}`,
	],
};
