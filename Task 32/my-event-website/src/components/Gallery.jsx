import React from "react";

function Gallery() {
  return (
    <section id="gallery">
      <div className="section-title">
        <h2>Event Gallery</h2>
        <p>Highlights from our previous events.</p>
      </div>

      <div className="gallery-grid">
        <img src="https://picsum.photos/400/300?1" alt="" />
        <img src="https://picsum.photos/400/300?2" alt="" />
        <img src="https://picsum.photos/400/300?3" alt="" />
        <img src="https://picsum.photos/400/300?4" alt="" />
        <img src="https://picsum.photos/400/300?5" alt="" />
        <img src="https://picsum.photos/400/300?6" alt="" />
      </div>
    </section>
  );
}

export default Gallery;