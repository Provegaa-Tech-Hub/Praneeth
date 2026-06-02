import "./App.css";

import Navbar from "./components/Navbar";
import Hero from "./components/Hero";
import About from "./components/About";
import Stats from "./components/Stats";
import Speakers from "./components/Speakers";
import Schedule from "./components/Schedule";
import Tickets from "./components/Tickets";
import Gallery from "./components/Gallery";
import Sponsors from "./components/Sponsors";
import Testimonials from "./components/Testimonials";
import FAQ from "./components/FAQ";
import Register from "./components/Register";
import Contact from "./components/Contact";
import Footer from "./components/Footer";

function App() {
  return (
    <>
      <Navbar />
      <Hero />
      <About />
      <Stats />
      <Speakers />
      <Schedule />
      <Tickets />
      <Gallery />
      <Sponsors />
      <Testimonials />
      <FAQ />
      <Register />
      <Contact />
      <Footer />
    </>
  );
}

export default App;