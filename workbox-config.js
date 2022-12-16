module.exports = {
	globDirectory: '.',
	globPatterns: [
		'**/*.{html,json,css,png,js,webp, php}'
	],
	swDest: 'sw.js',
	ignoreURLParametersMatching: [
		/^utm_/,
		/^fbclid$/
	]
};