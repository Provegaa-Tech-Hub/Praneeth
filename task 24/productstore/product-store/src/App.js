import React from "react";
import ProductList from "./components/ProductList";
import "./App.css";

function App() {
  return (
    <div>
      <h1 className="title">🛒 Product Store</h1>
      <ProductList />
    </div>
  );
}

export default App;