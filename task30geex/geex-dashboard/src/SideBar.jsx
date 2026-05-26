import React, { useState } from "react";

import {
  House,
  LayoutGrid,
  AppWindow,
  Layers3,
  FileText,
} from "lucide-react";

import { Link } from "react-router-dom";


// Sidebar Menu Data
const menuItems = [
  {
    id: 1,
    title: "Demo",
    icon: <House size={26} />,
    submenu: [
      "Server Management",
      "Banking",
      "Crypto",
      "Invoicing",
    ],
  },

  {
    id: 2,
    title: "Layout",
    icon: <LayoutGrid size={26} />,
  },

  {
    id: 3,
    title: "App",
    icon: <AppWindow size={26} />,
  },

  {
    id: 4,
    title: "Features",
    icon: <Layers3 size={26} />,
  },

  {
    id: 5,
    title: "Pages",
    icon: <FileText size={26} />,
  },
];


const Sidebar = () => {

  const [openDemo, setOpenDemo] = useState(false);

  const [openPages, setOpenPages] = useState(false);

  return (

    <div className="sidebar">

      {/* Logo */}
      <div className="logo-icon">

        <img
          src="/images/logo-dark.svg"
          alt="logo"
        />

      </div>


      {/* Menu */}
      <div className="menu-list">

        {menuItems.map((item) => (

          <div key={item.id}>

            {/* Main Menu Item */}
            <div
              className="menu-item"

              onClick={() => {

                // Demo Dropdown
                if (item.title === "Demo") {
                  setOpenDemo(!openDemo);
                }

                // Pages Dropdown
                if (item.title === "Pages") {
                  setOpenPages(!openPages);
                }
              }}
            >

              <div className="menu-icon">
                {item.icon}
              </div>

              <span>{item.title}</span>

            </div>


            {/* Demo Dropdown */}
            {item.title === "Demo" && openDemo && (

              <div className="dropdown-menu">

                {item.submenu.map((sub, index) => (

                  <p key={index}>
                    {sub}
                  </p>

                ))}

              </div>
            )}


            {/* Pages Dropdown */}
            {item.title === "Pages" && openPages && (

              <div className="dropdown-menu">

                {/* Sign In */}
                <Link
                  to="/signin"
                  style={{
                    textDecoration: "none",
                    color: "#666",
                    fontSize: "17px",
                  }}
                >
                  Sign In
                </Link>

                {/* Sign Up */}
                <Link
                  to="/signup"
                  style={{
                    textDecoration: "none",
                    color: "#666",
                    fontSize: "17px",
                  }}
                >
                  Sign Up
                </Link>

              </div>
            )}

          </div>
        ))}

      </div>


      {/* Footer */}
      <div className="sidebar-footer">

        <h2>
          Geex Modern Dashboard
        </h2>

        <p>
          © 2024 All Rights Reserved
        </p>

        <span>
          Made with ❤️ by ThemeWant
        </span>

      </div>

    </div>
  );
};

export default Sidebar;