import React, { useEffect, useState } from "react";

export default function ProductSearch() {
  const [products, setProducts] = useState([]);
  const [search, setSearch] = useState("");

  // Fetch API
  useEffect(() => {
    fetch("https://fakestoreapi.com/products")
      .then(res => res.json())
      .then(data => setProducts(data));
  }, []);

  // Filter products
  const filtered = products.filter(item =>
    item.title.toLowerCase().includes(search.toLowerCase())
  );

  return (
    <div className="container">
      <h2>Product Search</h2>

      <input
        type="text"
        placeholder="Search product..."
        value={search}
        onChange={(e) => setSearch(e.target.value)}
      />

      <div className="grid">
        {filtered.map(product => (
          <div className="card" key={product.id}>
            <img src={product.image} alt="" />
            <h4>{product.title}</h4>
            <p>${product.price}</p>
          </div>
        ))}
      </div>
    </div>
  );
}