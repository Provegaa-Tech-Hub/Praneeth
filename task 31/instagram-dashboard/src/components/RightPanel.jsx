import React from "react";

const RightPanel = () => {
  return (

    <div className="right-panel">

      <div className="profile-section">

        <img
          src="https://randomuser.me/api/portraits/men/45.jpg"
          alt=""
        />

        <div>

          <h4>suram_praneeth</h4>

          <p>React Developer</p>

        </div>

      </div>

      <div className="suggestions-header">

        <span>Suggestions For You</span>

        <a href="/">See All</a>

      </div>

      <div className="suggestion-user">

        <img
          src="https://randomuser.me/api/portraits/women/20.jpg"
          alt=""
        />

        <div>

          <h5>sara_dev</h5>

          <p>Suggested for you</p>

        </div>

        <button>Follow</button>

      </div>

      <div className="suggestion-user">

        <img
          src="https://randomuser.me/api/portraits/men/25.jpg"
          alt=""
        />

        <div>

          <h5>alex_ui</h5>

          <p>Suggested for you</p>

        </div>

        <button>Follow</button>

      </div>

    </div>
  );
};

export default RightPanel;