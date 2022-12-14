module.exports = {
	globDirectory: '.',
	globPatterns: [
		'**/*.{html,json,css,png,js}'
	],
	swDest: 'sw.js',
	ignoreURLParametersMatching: [
		/^utm_/,
		/^fbclid$/
	]
};