const nodeEnv = process.env.NODE_ENV;
const mode = nodeEnv ? nodeEnv : 'development';
const postcssPresetEnv = require( 'postcss-preset-env' );
const atImport = require( 'postcss-import' );
const url = require( 'postcss-url' );
const cssnano = require( 'cssnano' );

module.exports = {
	map: mode === 'development',
	plugins: [
		require( 'postcss-omit-import-tilde' ),
		atImport( {
			extensions: [
				'.css',
				'.scss',
				'.pcss',
			],
		} ),
		url(),
		postcssPresetEnv( {
			stage: 3,
			features: {
				'nesting-rules': true,
				'custom-media-queries': true,
			},
			autoprefixer: {
				grid: true,
			},
		} ),
		mode === 'development' ? null : cssnano(),
	],
};
