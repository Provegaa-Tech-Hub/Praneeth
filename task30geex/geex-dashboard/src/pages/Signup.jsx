import React from "react";

const Signup = () => {
  return (

    <div className="signin-container">

      {/* Left Side */}
      <div className="signin-left">

        {/* Logo */}
        <div className="logo">

          <img
            src="/images/logo-dark.svg"
            alt="logo"
          />

        </div>

        {/* Heading */}
        <h1>
          Sing Up Your Account 👋
        </h1>

        {/* Form */}
        <form>

          {/* Email */}
          <label>Your Email</label>

          <input
            type="email"
            placeholder="Enter Your Email"
            required
          />

          {/* Password */}
          <label>Password</label>

          <input
            type="password"
            placeholder="Password"
            required
          />

          {/* Confirm Password */}
          <label>Confirm Password</label>

          <input
            type="password"
            placeholder="Password"
            required
          />

          {/* Terms */}
          <div className="remember">

            <input type="checkbox" />

            <p>
              By creating a account you agree to Our
              <span style={{ color: "#a855f7" }}>
                {" "}terms & conditions
              </span>
              <br />
              <span style={{ color: "#a855f7" }}>
                Privacy Policy
              </span>
            </p>

          </div>

          {/* Button */}
          <button type="submit">
            Sign Up
          </button>

        </form>

      </div>

      {/* Right Side */}
      <div className="signin-right">

        <img
          src="/images/signin-image.png"
          alt="signup"
        />

      </div>

    </div>
  );
};

export default Signup;