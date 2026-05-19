function Hero() {

    const donors = [

        {
            id: 1,
            image: "/images/user-1.png"
        },

        {
            id: 2,
            image: "/images/user-2.png"
        },

        {
            id: 3,
            image: "/images/user-3.png"
        }

    ];

    return (

        <section className="hero">

            <div className="backimg-style">

                <div className="hero-inner-div">

                    <div className="hero-left">

                        <p className="tagline">
                            ❤️ Change The World Together
                        </p>

                        <h1>
                            For The People & <br />
                            Cause You Care About
                        </h1>

                        <p className="description">
                            It is a long established fact that a reader will be distracted
                            lorem the readable content of a page when looking at layout.
                        </p>

                        <div className="hero-actions">

                            <button className="donate-btn">

                                <div className="arrowcircle-styles">

                                    <img
                                        src="/images/fast-forward-double-right-arrows-symbol.png"
                                        className="arrow-styles"
                                        alt="arrow"
                                    />

                                </div>

                                <div className="hero-text">
                                    Make Donation
                                </div>

                            </button>

                            <div className="donors">

                                {
                                    donors.map((donor) => (

                                        <img
                                            key={donor.id}
                                            src={donor.image}
                                            alt="donor"
                                        />

                                    ))
                                }

                                <span className="number">
                                    2M
                                </span>

                                <div className="donors-text">
                                    Active donors
                                </div>

                            </div>

                        </div>

                        <div>

                            <img
                                src="/images/vector-img.png"
                                className="vectorimg"
                                alt="vector"
                            />

                        </div>

                    </div>

                    <div className="hero-right">

                        <img
                            src="/images/banner-img.png"
                            alt="Hero"
                        />

                    </div>

                </div>

            </div>

        </section>

    );
}

export default Hero;