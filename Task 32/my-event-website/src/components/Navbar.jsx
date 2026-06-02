import React from "react";

function Navbar() {
  return (
    <nav className="navbar">
      <div className="logo">EventPro</div>

      <div className="nav-links">
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#speakers">Speakers</a>
        <a href="#schedule">Schedule</a>
        <a href="#tickets">Tickets</a>
        <a href="#contact">Contact</a>
      </div>
    </nav>
  );
}

export default Navbar;