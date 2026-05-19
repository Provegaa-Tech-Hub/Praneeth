
function Testimonial(){
    return(
<section className="testimonial-section">

    <div className="testimonal-main">

        <div className="testimonal-styles">
            ❤️ Testimonials
        </div>

        <div className="talking-about">
            What They Are Talking About Charitics
        </div>

    </div>

    <div className="container">

        {/* CAROUSEL */}

        <div
            id="testimonialCarousel"
            className="carousel slide"
            data-bs-ride="carousel"
            data-bs-interval="2000"
        >

            <div className="carousel-inner">

                {/* SLIDE 1 */}

                <div className="carousel-item active">

                    <div className="row g-4">

                        {/* CARD 1 */}

                        <div className="col-lg-3 col-md-6">

                            <div className="testimonial-card">

                                <div className="stars">
                                    ★★★★☆
                                </div>

                                <p className="testimonial-text">
                                    Praesent ut lacus a velit tincidunt aliquam
                                    a eget urna.Sed ullamcoper tristique nisl at
                                    pharetra tupis accumsan et etiam eu
                                    sollicititudin eros.
                                </p>

                                <div className="profile">

                                    <div className="profile-left">

                                        <img
                                            src="/images/member-1.jpg"
                                            alt="member1"
                                        />

                                        <div>

                                            <h5>Esther Howard</h5>

                                            <p>Web Designer</p>

                                        </div>

                                    </div>

                                    <div className="quote">

                                        <i className="fa-solid fa-quote-right"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                        {/* CARD 2 */}

                        <div className="col-lg-3 col-md-6">

                            <div className="testimonial-card">

                                <div className="stars">
                                    ★★★★☆
                                </div>

                                <p className="testimonial-text">
                                    Praesent ut lacus a velit tincidunt aliquam
                                    a eget urna.Sed ullamcoper tristique nisl at
                                    pharetra tupis accumsan et etiam eu
                                    sollicititudin eros.
                                </p>

                                <div className="profile">

                                    <div className="profile-left">

                                        <img
                                            src="/images/member-2.jpg"
                                            alt="member2"
                                        />

                                        <div>

                                            <h5>Esther Howard</h5>

                                            <p>Web Designer</p>

                                        </div>

                                    </div>

                                    <div className="quote">

                                        <i className="fa-solid fa-quote-right"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                        {/* CARD 3 */}

                        <div className="col-lg-3 col-md-6">

                            <div className="testimonial-card">

                                <div className="stars">
                                    ★★★★☆
                                </div>

                                <p className="testimonial-text">
                                    Praesent ut lacus a velit tincidunt aliquam
                                    a eget urna.Sed ullamcoper tristique nisl at
                                    pharetra tupis accumsan et etiam eu
                                    sollicititudin eros.
                                </p>

                                <div className="profile">

                                    <div className="profile-left">

                                        <img
                                            src="/images/member-3.jpg"
                                            alt="member3"
                                        />

                                        <div>

                                            <h5>Esther Howard</h5>

                                            <p>UI Designer</p>

                                        </div>

                                    </div>

                                    <div className="quote">

                                        <i className="fa-solid fa-quote-right"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                        {/* CARD 4 */}

                        <div className="col-lg-3 col-md-6">

                            <div className="testimonial-card">

                                <div className="stars">
                                    ★★★★☆
                                </div>

                                <p className="testimonial-text">
                                    Praesent ut lacus a velit tincidunt aliquam
                                    a eget urna.Sed ullamcoper tristique nisl at
                                    pharetra tupis accumsan et etiam eu
                                    sollicititudin eros.
                                </p>

                                <div className="profile">

                                    <div className="profile-left">

                                        <img
                                            src="/images/member-4.jpg"
                                            alt="member4"
                                        />

                                        <div>

                                            <h5>Esther Howard</h5>

                                            <p>Web Designer</p>

                                        </div>

                                    </div>

                                    <div className="quote">

                                        <i className="fa-solid fa-quote-right"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {/* SLIDE 2 */}

                <div className="carousel-item">

                    <div className="row g-4">

                        {/* CARD 5 */}

                        <div className="col-lg-3 col-md-6">

                            <div className="testimonial-card">

                                <div className="stars">
                                    ★★★★☆
                                </div>

                                <p className="testimonial-text">
                                    Praesent ut lacus a velit tincidunt aliquam
                                    a eget urna.Sed ullamcoper tristique nisl at
                                    pharetra tupis accumsan et etiam eu
                                    sollicititudin eros.
                                </p>

                                <div className="profile">

                                    <div className="profile-left">

                                        <img
                                            src="/images/member-2.jpg"
                                            alt="member2"
                                        />

                                        <div>

                                            <h5>Esther Howard</h5>

                                            <p>Web Designer</p>

                                        </div>

                                    </div>

                                    <div className="quote">

                                        <i className="fa-solid fa-quote-right"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {/* DOTS */}

            <div className="carousel-indicators position-static mt-4">

                <button
                    type="button"
                    data-bs-target="#testimonialCarousel"
                    data-bs-slide-to="0"
                    className="active"
                >
                </button>

                <button
                    type="button"
                    data-bs-target="#testimonialCarousel"
                    data-bs-slide-to="1"
                >
                </button>

            </div>

        </div>

    </div>

</section>
    )
}

export default Testimonial