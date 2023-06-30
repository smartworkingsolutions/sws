module.exports = {
	content: ["**/*.{html,php,svg}", "js/custom.js", "../../**/*.php"],
	theme: {
		container: {
			center: true,
			padding: {
				DEFAULT: '1.5rem',
				lg: '2.5rem',
				'2xl': '4rem',
				'4xl': '5rem',
			},
		},
		extend: {
			colors: {
				'body': 'var(--color-body)',
				'blue-dark': 'var(--color-blue-dark)',
				'blue-medium': 'var(--color-blue-medium)',
				'blue-light': 'var(--color-blue-light)',
				'dark-color': 'var(--color-dark)',
				'border-color': 'var(--color-border)',
				'text-color': 'var(--color-text)',
			},
			screens: {
				'2xl': '1440px',
				'3xl': '1600px',
				'4xl': '1820px',
			},
			transitionProperty: {
				'height': 'height',
				'spacing': 'margin, padding',
			},
			spacing: {
				'100': '100px',
			},
			fontSize: {
				'22': '1.375rem',
				'32': '2rem',
				'58': '3.625rem',
			},
			borderRadius: {
				'10': '10px',
				'14': '14px',
				'20': '20px',
			},
			borderWidth: {
				'5': '5px',
			}
		},
	},
	plugins: [
		require('@tailwindcss/forms'),
	],
}
