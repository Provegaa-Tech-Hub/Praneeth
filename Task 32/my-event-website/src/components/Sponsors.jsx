import React from "react";

function Sponsors() {
  const sponsors = [
    {
      name: "Google",
      logo: "https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg",
    },
    {
      name: "Microsoft",
      logo: "https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg",
    },
    {
      name: "Amazon",
      logo: "https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg",
    },
    {
      name: "Meta",
      logo: "https://upload.wikimedia.org/wikipedia/commons/a/ab/Meta-Logo.png",
    },
    {
      name: "Adobe",
      logo: "https://upload.wikimedia.org/wikipedia/commons/7/7b/Adobe_Systems_logo_and_wordmark.svg",
    },
    {
      name: "IBM",
      logo: "https://upload.wikimedia.org/wikipedia/commons/5/51/IBM_logo.svg",
    },
  ];

  return (
    <section id="sponsors">
      <div className="section-title">
        <h2>Our Sponsors</h2>
        <p>Trusted by leading technology companies worldwide.</p>
      </div>

      <div className="sponsor-grid">
        {sponsors.map((sponsor, index) => (
          <div className="sponsor-box" key={index}>
            <img src={sponsor.logo} alt={sponsor.name} />
          </div>
        ))}
      </div>
    </section>
  );
}

export default Sponsors;