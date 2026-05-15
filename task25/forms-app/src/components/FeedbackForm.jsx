import React, { useState } from "react";
import "./Forms.css";

function FeedbackForm() {
  const [feedback, setFeedback] = useState({
    name: "",
    message: "",
    rating: ""
  });

  return (
    <div className="form-container">
      <h2>Feedback Form</h2>

      <input
        type="text"
        placeholder="Your Name"
        onChange={(e) => setFeedback({ ...feedback, name: e.target.value })}
      />

      <textarea
        placeholder="Your Feedback"
        onChange={(e) => setFeedback({ ...feedback, message: e.target.value })}
      ></textarea>

      <select
        onChange={(e) => setFeedback({ ...feedback, rating: e.target.value })}
      >
        <option value="">Select Rating</option>
        <option>Excellent</option>
        <option>Good</option>
        <option>Average</option>
      </select>

      <div className="preview">
        <h3>Preview</h3>
        <p>Name: {feedback.name}</p>
        <p>Message: {feedback.message}</p>
        <p>Rating: {feedback.rating}</p>
      </div>
    </div>
  );
}

export default FeedbackForm;