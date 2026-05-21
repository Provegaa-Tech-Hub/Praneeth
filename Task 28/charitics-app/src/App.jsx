import React, { useState, useEffect } from "react";
import "./App.css";
import Home from "./pages/Home";
import ThemeToggle from "./components/ThemeToggle";

function App() {
  const [theme, setTheme] = useState("light");

  // Load saved theme
  useEffect(() => {
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) setTheme(savedTheme);
  }, []);

  // Save theme
  useEffect(() => {
    localStorage.setItem("theme", theme);
  }, [theme]);

  const toggleTheme = () => {
    setTheme(theme === "light" ? "dark" : "light");
  };

  return (
    <div className={`app ${theme}`}>
      <ThemeToggle toggleTheme={toggleTheme} theme={theme} />
      <Home />
    </div>
  );
}

export default App;