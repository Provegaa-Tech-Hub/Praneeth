import React from "react";

const Header = () => {
  return (
    <header className="geex-header">
      <div className="geex-header__wrapper">

        {/* Logo */}
        <div className="geex-header__logo-wrapper">
          <a href="/" className="geex-header__logo">
            <img
              className="logo-lite"
              src="/assets/img/logo-dark.svg"
              alt="logo"
            />
            <img
              className="logo-dark"
              src="/assets/img/logo-lite.svg"
              alt="logo"
            />
          </a>
        </div>

        {/* Menu */}
        <nav className="geex-header__menu-wrapper">
          <ul className="geex-header__menu">

            {/* Demo */}
            <li className="geex-header__menu__item has-children">
              <a href="#" className="geex-header__menu__link">
                <span>Demo</span>
              </a>

              <ul className="geex-header__submenu">
                <li><a href="/">Server Management</a></li>
                <li><a href="/">Banking</a></li>
                <li><a href="/">Crypto</a></li>
                <li><a href="/">Invoicing</a></li>
              </ul>
            </li>

            {/* Layout */}
            <li className="geex-header__menu__item has-children">
              <a href="#" className="geex-header__menu__link">
                <span>Layout</span>
              </a>

              <ul className="geex-header__submenu">
                <li><a href="#">Top Menu</a></li>
                <li><a href="#">Side Menu</a></li>
                <li><a href="#">Light Demo</a></li>
                <li><a href="#">Dark Demo</a></li>
              </ul>
            </li>

            {/* App */}
            <li className="geex-header__menu__item has-children">
              <a href="#" className="geex-header__menu__link">
                <span>App</span>
              </a>

              <ul className="geex-header__submenu">
                <li><a href="#">Todo</a></li>
                <li><a href="#">Chat</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </li>

          </ul>
        </nav>
      </div>
    </header>
  );
};

export default Header;