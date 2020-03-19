module.exports = {
	theme: {
		extend: {
			colors: {
				'gray-950': '#161d2b',
				'gray-1000': '#141925',
			},
			spacing: {
				'72': '18rem',
				'84': '21rem',
				'96': '24rem',
			},
			boxShadow: {
				btn: '0px 0px 2px rgba(0,0,0,.7)',
			}
		},
	},
	variants: {},
	plugins: [
	require('@tailwindcss/custom-forms'),
	],
}