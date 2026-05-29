// src/components/Sidebar.jsx

import React from "react";

import {
  Home,
  Search,
  Compass,
  Film,
  MessageSquare,
  Heart,
  PlusSquare,
  Menu,
} from "lucide-react";

const Sidebar = () => {
  return (

    <div className="instagram-sidebar">

      {/* Logo */}

      <div className="instagram-logo-box">

  <img
    src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png"
    alt="instagram"
    className="instagram-logo-img"
  />

  <h1 className="instagram-logo">
    Instagram
  </h1>

</div>
      {/* Menu */}

      <div className="instagram-menu">

        <div className="menu-item active">

          <Home size={28} />

          <span>Home</span>

        </div>

        <div className="menu-item">

          <Search size={28} />

          <span>Search</span>

        </div>

        <div className="menu-item">

          <Compass size={28} />

          <span>Explore</span>

        </div>

        <div className="menu-item">

          <Film size={28} />

          <span>Reels</span>

        </div>

        <div className="menu-item">

          <MessageSquare size={28} />

          <span>Messages</span>

        </div>

        <div className="menu-item">

          <Heart size={28} />

          <span>Notifications</span>

        </div>

        <div className="menu-item">

          <PlusSquare size={28} />

          <span>Create</span>

        </div>

      </div>

      {/* Bottom */}

      <div className="bottom-menu">

        <div className="menu-item">

          <Menu size={28} />

          <span>More</span>

        </div>

      </div>

    </div>
  );
};

export default Sidebar;