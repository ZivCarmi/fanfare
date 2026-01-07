/** @type {import('tailwindcss').Config} */

const headerHeight = "64px";

module.exports = {
  darkMode: ["class"],
  content: ["./**/*.php", "./assets/js/**/*.js"],
  theme: {
    screens: {
      sm: "640px",
      md: "768px",
      lg: "1024px",
      xl: "1280px",
      "1.5xl": "1380px",
      "2xl": "1536px",
      xxl: "2501px",
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
      cursor: {
        input: "url(/wp-content/uploads/2024/11/input-cursor.svg), text",
      },
      zIndex: {
        cursor: "999999",
      },
      fontSize: {
        base: ["1rem", "1.125rem"],
        "4xl": ["2.25rem", "2.025rem"],
        "6xl": ["3.75rem", "4.125rem"],
        "12px": ["0.75rem", "0.8125rem"],
        "22px": ["1.375rem", "1.5rem"],
        "26px": ["1.625rem", "1"],
        "28px": ["1.75rem", "1"],
        "34px": ["2.125rem", "2.3125rem"],
        "36px": ["2.25rem", "2.5rem"],
        "56px": ["3.5rem", "1"],
        "60px": ["3.75rem", "3.375rem"],
        "80px": ["5rem", "4.5rem"],
        "140px": ["8.75rem", "0.85"],
        "200px": ["12.5rem", "11.25rem"],
      },
      height: {
        "hero-screen": `calc(100dvh - ${headerHeight})`,
        "form-mobile-height": "calc(100dvh - 8.8125rem)",
      },
      spacing: {
        "work-grid-y": "16px",
        "work-grid-x": "17px",
        "30px": "1.875rem",
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
        "about-mobile": "minmax(3rem, 1fr)",
        process: "61% 13% 13% 13%",
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
        "2px": "2px",
        "3px": "3px",
        "10px": "10px",
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
