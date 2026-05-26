import React from "react";

const SignIn = () => {
  return (

    <div className="signin-container">

      {/* Left Side */}
      <div className="signin-left">

        {/* Logo */}
        <div className="logo">

          <img
            src="./images/logo-dark.svg"
            alt="logo"
          />

        </div>

        {/* Heading */}
        <h1>
          Sign In to Your Account 👋
        </h1>

        {/* Form */}
        <form>

          <label>Your Email</label>

          <input
            type="email"
            placeholder="Enter Your Email"
          />

          <div className="password-top">

            <label>Your Password</label>

            <span>Forgot Password?</span>

          </div>

          <input
            type="password"
            placeholder="Password"
          />

          <div className="remember">

            <input type="checkbox" />

            <p>Remember Me</p>

          </div>

          <button>
            Sign In
          </button>

        </form>

      </div>

      {/* Right Side */}
      <div className="signin-right">

        <img
          src="./images/signin-image.png"
          alt="signin"
        />

      </div>

    </div>
  );
};

export default SignIn;