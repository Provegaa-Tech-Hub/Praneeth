import React from "react";

function Stats() {
  return (
    <section>
      <div className="section-title">
        <h2>Event Statistics</h2>
      </div>

      <div className="stats-grid">
        <div className="stat-box">
          <h3>50+</h3>
          <p>Speakers</p>
        </div>

        <div className="stat-box">
          <h3>3000+</h3>
          <p>Attendees</p>
        </div>

        <div className="stat-box">
          <h3>40+</h3>
          <p>Sessions</p>
        </div>

        <div className="stat-box">
          <h3>20+</h3>
          <p>Sponsors</p>
        </div>
      </div>
    </section>
  );
}

export default Stats;