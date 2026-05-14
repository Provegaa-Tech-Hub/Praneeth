import React from "react";
import StudentTable from "./StudentTable";
import ProductCards from "./ProductCards";
import MovieList from "./MovieList";

function App() {
  return (
    <div>
      <h1 style={{ textAlign: "center" }}>My new project</h1>

      {/* Task 1: Student Table */}
      <StudentTable />

      {/* Task 2: Product Cards */}
      <ProductCards />

      {/* Task 3: Movie List (BookMyShow Style) */}
      <MovieList />
    </div>
  );
}

export default App;