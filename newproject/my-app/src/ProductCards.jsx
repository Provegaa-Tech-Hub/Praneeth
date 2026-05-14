import React from "react";
import "./Product.css";

function ProductCards() {
  const products = [
    {
      id: 1,
      name: "Shoes",
      price: 1999,
      image: "https://via.placeholder.com/150"
    },
    {
      id: 2,
      name: "Watch",
      price: 2999,
      image: "https://via.placeholder.com/150"
    },
    {
      id: 3,
      name: "Phone",
      price: 15000,
      image: "https://via.placeholder.com/150"
    }
  ];

  return (
    <div>
      <h2>Products</h2>

      <div className="product-container">
        {products.map((item) => (
          <div className="card" key={item.id}>
            <img src={item.image} alt={item.name} />
            <h3>{item.name}</h3>
            <p>₹ {item.price}</p>
            <button>Buy Now</button>
          </div>
        ))}
      </div>
    </div>
  );
}

export default ProductCards;