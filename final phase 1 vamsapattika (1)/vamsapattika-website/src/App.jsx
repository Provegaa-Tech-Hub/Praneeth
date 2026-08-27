import React, { useState } from "react";
import Header from "./components/Header";
import Hero from "./components/Hero";
import About from "./components/About";
import Features from "./components/Features";
import Vision from "./components/Vision";
import Process from "./components/Process";
import Why from "./components/Why";
import Privacy from "./components/Privacy";
import FAQ from "./components/FAQ";
import CTA from "./components/CTA";
import Footer from "./components/Footer";
import "./app.css";

function App() {
  const [openFaq, setOpenFaq] = useState(0);
  const [menuOpen, setMenuOpen] = useState(false);
  const scrollTo = (id) => {
    document.getElementById(id)?.scrollIntoView({ behavior: "smooth" });
    setMenuOpen(false);
  };

  return (
    <div className="site">
      <Header scrollTo={scrollTo} menuOpen={menuOpen} setMenuOpen={setMenuOpen} />
      <main>
        <Hero scrollTo={scrollTo} />
        <About />
        <Features />
        <Vision />
        <Process />
        <Why />
        <Privacy />
        <FAQ openFaq={openFaq} setOpenFaq={setOpenFaq} />
        <CTA scrollTo={scrollTo} />
      </main>
      <Footer scrollTo={scrollTo} />
    </div>
  );
}

export default App;
