import React from "react";
import "./style.css";

const data = [
  {
    title: "Food Donation",
    img: "https://images.unsplash.com/photo-1600891964599-f61ba0e24092"
  },
  {
    title: "Medical Help",
    img: "https://images.unsplash.com/photo-1588776814546-ec7e2d2d4d92"
  },
  {
    title: "Education",
    img: "https://images.unsplash.com/photo-1588072432836-e10032774350"
  }
];

export default function Causes() {
  return (
    <section className="causes">
      <h2>Our Causes</h2>
      <div className="cards">
        {data.map((item, i) => (
          <div className="card" key={i}>
            <img src={item.img} alt="" />
            <h3>{item.title}</h3>
            <button className="btn">Donate</button>
          </div>
        ))}
      </div>
    </section>
  );
}