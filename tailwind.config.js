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
				btn: '0px 1px 1px 1px rgba(0,0,0,.2)',
				stacked: '1px 1px 2px rgba(0,0,0,.3), 0px 8px 0px -3px #1a202c, 0px 8px 3px -3px rgba(0,0,0,.2)',
				navbar: '0px 2px 8px rgba(0,0,0,0.2)',
				row: '1px 1px 2px rgba(0,0,0,.3)',
			}
		},
	},
	variants: {},
	plugins: [
	require('@tailwindcss/custom-forms'),
	],
}