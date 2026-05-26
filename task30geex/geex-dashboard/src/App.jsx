import React from "react";

import {
  BrowserRouter,
  Routes,
  Route,
} from "react-router-dom";

import FeatureCard from "./FeaturedCard";
import Header from "./Header";
import DashboardCards from "./BodyBox";
import Sidebar from "./SideBar";
import WidgetHeader from "./WidgetHeader";

import Signin from "./pages/Signin";
import Signup from "./pages/Signup";

import "./App.css";


// Dashboard Page
function Dashboard() {
  return (

    <div>

      <Sidebar />

      <Header />

      <FeatureCard />

      <DashboardCards />

      <WidgetHeader />

    </div>
  );
}


// Main App
function App() {
  return (

    <BrowserRouter>

      <Routes>

        {/* Dashboard */}
        <Route
          path="/"
          element={<Dashboard />}
        />

        {/* Sign In */}
        <Route
          path="/signin"
          element={<Signin />}
        />

        {/* Sign Up */}
        <Route
          path="/signup"
          element={<Signup />}
        />

      </Routes>

    </BrowserRouter>

  );
}

export default App;