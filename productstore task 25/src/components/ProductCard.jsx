import React from "react";
import "./Product.css";

function ProductCard({ product }) {
  return (
    <div className="card">
      <img src={product.image} alt={product.title} />

      <h3>{product.title}</h3>

      <p className="price">₹ {product.price}</p>

      <p className="category">{product.category}</p>

      <button>Buy Now</button>
    </div>
  );
}

export default ProductCard;