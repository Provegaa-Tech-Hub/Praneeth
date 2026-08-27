import React from "react";
import "./Header.css";

export default function Header({ scrollTo, menuOpen, setMenuOpen }) {
  const FAMILY_TREE_URL = import.meta.env.VITE_FAMILY_TREE_URL || "http://localhost:5175";
  return (
    <header className="header">
      <div className="container nav">
        <button className="brand" onClick={() => scrollTo("home")} aria-label="Vamsapattika home">
          <img src="/vamsapattika-logo.jpeg" alt="Vamsapattika logo" />
        </button>
        <button className="menu-toggle" onClick={() => setMenuOpen(!menuOpen)} aria-label="Toggle navigation">☰</button>
        <nav className={menuOpen ? "nav-links open" : "nav-links"}>
          <button onClick={() => scrollTo("home")}>Home</button>
          <button onClick={() => scrollTo("about")}>About</button>
          <button onClick={() => scrollTo("features")}>Features</button>
          <button onClick={() => scrollTo("how-it-works")}>How It Works</button>
          <button onClick={() => scrollTo("faq")}>FAQ</button>
          <button className="nav-cta" onClick={() => { window.location.href = FAMILY_TREE_URL; }}>LOGIN / REGISTER</button>
        </nav>
      </div>
    </header>
  );
}
