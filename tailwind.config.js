import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                //servizi
                'color-017c67': '#017C67',
                'color-01bca0': '#01BCA0',
                'color-a6cb0d': '#A6CB0D',
                'color-74d4ff': '#74D4FF',
                'color-7a95db': '#7A95DB',
                'color-5e53dd': '#5E53DD',
                //
                'color-ffb205': '#FFB205',
                'color-01a53a': '#01A53A',
                'color-ffdbc1': '#FFDBC1',
                'color-e9863e': '#E9863E',
                'color-17489f': '#17489F',
                'color-347af2': '#347AF2',
                'color-c9defa': '#C9DEFA',
                'color-2c2c2c': '#2C2C2C',
                'color-545454': '#545454',
                'color-afafaf': '#AFAFAF',
                'color-dfdfdf': '#DFDFDF',
                'color-efefef': '#EFEFEF',
                'color-538ef4': '#538ef4',
                'color-f4f8ff': '#f4f8ff',
            },
            boxShadow: {
                'shadow-b': '0px 5px 10px -7px #000000'
            },
            backgroundImage: {
                login: "url('/resources/images/login.png')"
            }
        },
    },

    plugins: [forms],
};
