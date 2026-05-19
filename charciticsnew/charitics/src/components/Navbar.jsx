
function Navbar(){
    return(
<div className="about">

    <div className="about-left">

        <div>
            <img
                src="/images/about-img.png"
                alt="about"
                className="img_size"
            />
        </div>

    </div>

    <div className="about-right">

        <p className="abouttag">
            ❤️ About US
        </p>

        <h1>
            Helping Each Other can Make World Better
        </h1>

        <div className="aboutdesc">
            Dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
            The aspernaturaut odit aut fugit, sed quia consequuntur.
            Nonprofits around the world apply and join us to access more funding.
        </div>

        <div className="team">

            <div style={{ display: "flex" }}>

                <div style={{ display: "flex" }}>

                    <div className="love-bg-img">

                        <img
                            src="/images/in-love.png"
                            className="love-img"
                            alt="love"
                        />

                    </div>

                    <div className="start-text">
                        Start Helping Team
                    </div>

                </div>

                <div className="avatars">

                    <img
                        src="/images/about-block-img.jpg"
                        alt="team"
                    />

                </div>

            </div>

            <div>

                <div>

                    <img
                        src="/images/check-circle.png"
                        style={{ width: "10px" }}
                        alt="check"
                    />

                    There are many variations of solve

                </div>

            </div>

        </div>

        <div className="buttons">

            <button className="donate-btn">

                <div className="arrowcircle-styles">

                    <img
                        src="/images/fast-forward-double-right-arrows-symbol.png"
                        className="arrow-styles"
                        alt="arrow"
                    />

                </div>

                <div className="hero-text">
                    Explore More
                </div>

            </button>

            <div className="telephone-styles">

                <div>

                    <img
                        src="/images/telephone-call.png"
                        className="telephone-img"
                        alt="phone"
                    />

                </div>

            </div>

            <div>

                <div className="call-time">
                    Call Any Time
                </div>

                <div className="number-style">
                    +61 2345 678 990
                </div>

            </div>

        </div>

    </div>

</div>
    )
}

export default Navbar