import React from "react";
import "./Movie.css";

// ✅ Import images (correct path)
import rrr from "./images/rrr.jpg";
import bahubali from "./images/bahubali.jpg";
import kgf from "./images/kgf.jpg";

function MovieList() {
  const movies = [
    {
      id: 1,
      title: "RRR",
      rating: 4.8,
      image: rrr
    },
    {
      id: 2,
      title: "Bahubali",
      rating: 4.7,
      image: bahubali
    },
    {
      id: 3,
      title: "KGF",
      rating: 4.6,
      image: kgf
    }
  ];

  return (
    <div>
      <h2>Movies</h2>

      <div className="movie-container">
        {movies.map((movie) => (
          <div className="movie-card" key={movie.id}>
            
            {/* ✅ Image showing */}
            <img src={movie.image} alt={movie.title} />

            <h3>{movie.title}</h3>
            <p>⭐ {movie.rating}</p>

            <button onClick={() => alert(movie.title)}>
              Book Now
            </button>

          </div>
        ))}
      </div>
    </div>
  );
}

export default MovieList;