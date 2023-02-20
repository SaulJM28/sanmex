module.exports = {
	globDirectory: '.',
	globPatterns: [
		'**/*.{json,dat,png,css,webp,js}'
	],
	swDest: 'sw.js',
	ignoreURLParametersMatching: [
		/^utm_/,
		/^fbclid$/
	]
};