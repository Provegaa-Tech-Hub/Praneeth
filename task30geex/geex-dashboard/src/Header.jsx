
import React from "react";
import { Search,MessageSquareMore,Bell,} from "lucide-react";


// Store all data in variables
const dashboardData = {
  title: "Dashboard",
  subtitle: "Welcome to Geex Modern Admin Dashboard",
  buttonText: "Customizer",
  notifications: 2,
  messages: 84,
  profileImg:
    "./images/user.svg",
};

const Header = () => {
  return (
    <div className="dashboard-header">
      
      {/* Left Side */}
      <div className="dashboard-left">
        <h1>{dashboardData.title}</h1>

        <p>{dashboardData.subtitle}</p>
      </div>

      {/* Right Side */}
      <div className="dashboard-right">

        <button className="custom-btn">
          {dashboardData.buttonText}
        </button>

        {/* Search Icon */}
        <div className="icon-box">
          <Search size={20} />
        </div>

        {/* Message Icon */}
        <div className="icon-box notification">
          <MessageSquareMore size={20} />

          <span className="badge orange">
            {dashboardData.messages}
          </span>
        </div>

        {/* Bell Icon */}
        <div className="icon-box notification">
          <Bell size={20} />

          <span className="badge blue">
            {dashboardData.notifications}
          </span>
        </div>

        {/* Profile Image */}
        <div className="profile">
          <img
            src={dashboardData.profileImg}
            alt="profile"
          />
        </div>
      </div>
    </div>
  );
};

export default Header;