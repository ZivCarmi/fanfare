/** @type {import('tailwindcss').Config} */

const headerHeight = "64px";

module.exports = {
  darkMode: ["class"],
  content: [
    "./*.{php,html,js}",
    "./assets/js/*.js",
    "./pages/**/*.{php,html,js}",
    "./template-parts/*.{php,html,js}",
  ],
  theme: {
    screens: {
      sm: "640px",
      md: "768px",
      lg: "1024px",
      xl: "1280px",
    },
    fontFamily: {
      Regular: ['"Regular"', "ui-sans-serif"],
    },
    container: {
      center: true,
      padding: {},
      screens: {},
    },
    extend: {
      fontSize: {
        base: ["1rem", "1.125rem"],
        "4xl": ["2.25rem", "2.025rem"],
        "6xl": ["3.75rem", "4.125rem"],
        "22px": ["1.375rem", "1.5rem"],
        "28px": ["1.75rem", "1"],
        "34px": ["2.125rem", "2.3125rem"],
        "36px": ["2.25rem", "2.5rem"],
        "80px": ["5rem", "4.5rem"],
      },
      height: {
        "hero-screen": `calc(100dvh - ${headerHeight})`,
        "form-mobile-height": "calc(100dvh - 141px)",
      },
      spacing: {
        "site-mobile": "1.25rem",
        "site-desktop": "3rem",
        "header-height": headerHeight,
      },
      backgroundSize: {
        "size-100-400": "100% 400%",
      },
      backgroundPosition: {
        "pos-0": "0% 0%",
        "pos-100": "100% 100%",
      },
      gridTemplateColumns: {
        process: "minmax(34.375rem, 55.625rem) repeat(3, minmax(10rem, 1fr))",
      },
      colors: {
        border: "hsl(var(--border))",
        input: "hsl(var(--input))",
        background: "hsl(var(--background))",
        foreground: "hsl(var(--foreground))",
        primary: {
          DEFAULT: "hsl(var(--primary))",
          foreground: "hsl(var(--primary-foreground))",
        },
        secondary: {
          DEFAULT: "hsl(var(--secondary))",
          foreground: "hsl(var(--secondary-foreground))",
        },
        popover: {
          DEFAULT: "hsl(var(--popover))",
          foreground: "hsl(var(--popover-foreground))",
        },
      },
      borderRadius: {
        lg: "var(--radius)",
        md: "calc(var(--radius) - 2px)",
        sm: "calc(var(--radius) - 4px)",
      },
      keyframes: {
        "accordion-down": {
          from: { height: 0 },
          to: { height: "var(--radix-accordion-content-height)" },
        },
        "accordion-up": {
          from: { height: "var(--radix-accordion-content-height)" },
          to: { height: 0 },
        },
      },
      animation: {
        "accordion-down": "accordion-down 0.2s ease-out",
        "accordion-up": "accordion-up 0.2s ease-out",
      },
    },
  },
  plugins: [],
};
