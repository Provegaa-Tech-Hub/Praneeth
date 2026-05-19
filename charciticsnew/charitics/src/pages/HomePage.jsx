import Hero from "../Hero";
import Navbar from "../Navbar";
import Events from '../Events';
import Donation from '../Donation';
import Stat from '../Stat';
import Volunteer from '../Volunteer';
import Body from '../Body';
import Testimonial from '../Testimonial';
import Blog from '../Blog';
import Gallery from '../Gallery';
import Contact from '../Contact';
import Footer from '../Footer';




function Home() {
    return (
        <div>


            <Hero />
            <Navbar />
            <Events />
            <Donation />
            <Stat />
            <Volunteer />
            <Body />
            <Testimonial />
            <Blog />
            <Gallery />
            <Contact />
            <Footer />
        </div>

    )
}
export default Home;