import React from "react";

function Schedule() {
  return (
    <section id="schedule">
      <div className="section-title">
        <h2>Event Schedule</h2>
      </div>

      <div className="schedule-item">
        <h3>09:00 AM - Opening Ceremony</h3>
        <p>Welcome speech and event introduction.</p>
      </div>

      <div className="schedule-item">
        <h3>11:00 AM - AI & Future Tech</h3>
        <p>Industry leaders discuss emerging technologies.</p>
      </div>

      <div className="schedule-item">
        <h3>02:00 PM - Startup Innovation</h3>
        <p>Learn from successful entrepreneurs.</p>
      </div>
    </section>
  );
}

export default Schedule;