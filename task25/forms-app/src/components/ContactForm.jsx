import React, { useState } from "react";
import "./Forms.css";

function ContactForm() {
  const [data, setData] = useState({
    name: "",
    email: "",
    message: ""
  });

  const [errors, setErrors] = useState({});

  const validate = () => {
    let err = {};

    if (!data.name) err.name = "Name is required";
    if (!data.email.includes("@")) err.email = "Valid email required";
    if (data.message.length < 5) err.message = "Message too short";

    setErrors(err);
    return Object.keys(err).length === 0;
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (validate()) {
      alert("Form Submitted Successfully ✅");
    }
  };

  return (
    <div className="form-container">
      <h2>Contact Form</h2>

      <form onSubmit={handleSubmit}>
        <input
          type="text"
          placeholder="Name"
          onChange={(e) => setData({ ...data, name: e.target.value })}
        />
        <p className="error">{errors.name}</p>

        <input
          type="email"
          placeholder="Email"
          onChange={(e) => setData({ ...data, email: e.target.value })}
        />
        <p className="error">{errors.email}</p>

        <textarea
          placeholder="Message"
          onChange={(e) => setData({ ...data, message: e.target.value })}
        ></textarea>
        <p className="error">{errors.message}</p>

        <button type="submit">Submit</button>
      </form>
    </div>
  );
}

export default ContactForm;