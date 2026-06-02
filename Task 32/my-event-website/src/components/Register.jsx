import React from "react";

function Register() {
  return (
    <section id="register">
      <div className="section-title">
        <h2>Register Now</h2>
      </div>

      <form className="register-form">
        <input type="text" placeholder="Full Name" />
        <input type="email" placeholder="Email Address" />
        <input type="tel" placeholder="Phone Number" />
        <textarea rows="5" placeholder="Message"></textarea>

        <button className="btn">Submit Registration</button>
      </form>
    </section>
  );
}

export default Register;