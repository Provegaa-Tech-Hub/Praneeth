import React from "react";

function FAQ() {
  return (
    <section id="faq">
      <div className="section-title">
        <h2>Frequently Asked Questions</h2>
      </div>

      <div className="faq-item">
        <h3>Where is the event held?</h3>
        <p>Hyderabad International Convention Center.</p>
      </div>

      <div className="faq-item">
        <h3>Can I buy tickets on the event day?</h3>
        <p>Yes, subject to availability.</p>
      </div>

      <div className="faq-item">
        <h3>Will recordings be available?</h3>
        <p>Yes, VIP ticket holders will receive recordings.</p>
      </div>
    </section>
  );
}

export default FAQ;