import React from "react";

function Tickets() {
  return (
    <section id="tickets">
      <div className="section-title">
        <h2>Ticket Pricing</h2>
      </div>

      <div className="ticket-grid">
        <div className="ticket-card">
          <h3>Basic</h3>
          <div className="ticket-price">$49</div>
          <p>1 Day Access</p>
          <button className="btn">Buy Now</button>
        </div>

        <div className="ticket-card">
          <h3>Standard</h3>
          <div className="ticket-price">$99</div>
          <p>2 Day Access</p>
          <button className="btn">Buy Now</button>
        </div>

        <div className="ticket-card">
          <h3>VIP</h3>
          <div className="ticket-price">$199</div>
          <p>Full Access</p>
          <button className="btn">Buy Now</button>
        </div>
      </div>
    </section>
  );
}

export default Tickets;