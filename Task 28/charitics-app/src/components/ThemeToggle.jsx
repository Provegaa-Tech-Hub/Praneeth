import React from "react";

function ThemeToggle({ toggleTheme, theme }) {
  return (
    <button onClick={toggleTheme} className="toggle-btn">
      {theme === "light" ? "🌙 Dark Mode" : "☀️ Light Mode"}
    </button>
  );
}

export default ThemeToggle;