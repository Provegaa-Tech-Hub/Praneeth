import React from "react";

function Speakers() {
  return (
    <section id="speakers">
      <div className="section-title">
        <h2>Featured Speakers</h2>
      </div>

      <div className="speaker-grid">
        <div className="speaker-card">
          <img
            src="https://images.unsplash.com/photo-1560250097-0b93528c311a"
            alt="speaker"
          />
          <h3>John Smith</h3>
          <p>CEO & Founder</p>
        </div>

        <div className="speaker-card">
          <img
            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330"
            alt="speaker"
          />
          <h3>Sarah Johnson</h3>
          <p>Tech Leader</p>
        </div>

        <div className="speaker-card">
          <img
            src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e"
            alt="speaker"
          />
          <h3>David Wilson</h3>
          <p>AI Expert</p>
        </div>
      </div>
    </section>
  );
}

export default Speakers;