require( 'dotenv' ).config();
const port = process.env.WP_PORT;
const theme = process.env.WP_THEME;
module.exports = {
	proxy: `localhost:${ port }`,
	files: [
		`./build/**/*.*`,
		`./**/*.{jpg,jpeg,gif,png,svg,php}`,
	],
};
