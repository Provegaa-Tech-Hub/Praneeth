
function Blog(){
    return(
<div className="blog-section">

    {/* Left Content */}

    <div className="left">

        <div className="blog-styles">
            Latest Blog
        </div>

        <div className="new-styles">
            Read Our Latest News
        </div>

        <div className="company-styles">
            We help companies develop powerful corporate
            social responsibility, grantmaking,
            and employee engagement strategies.
        </div>

        <div className="arrows">

            <button>
                <i className="fas fa-arrow-left"></i>
            </button>

            <button>
                <i className="fas fa-arrow-right"></i>
            </button>

        </div>

    </div>

    {/* Slider */}

    <div className="slider">

        <div className="slide-track">

            {/* Card 1 */}

            <div className="card">

                <img
                    src="/images/blog-1.jpg"
                    alt="blog1"
                />

                <span className="date">
                    15 Dec
                </span>

                <div style={{ display: "flex" }}>

                    <div className="margin-styles1">

                        <img
                            src="/images/person.png"
                            style={{ height: "auto", width: "10px" }}
                            alt="person"
                        />

                        By Admin

                    </div>

                    <div className="margin-styles2">

                        <img
                            src="/images/tag.png"
                            style={{ height: "auto", width: "15px" }}
                            alt="tag"
                        />

                        Donation

                    </div>

                </div>

                <hr />

                <h4>
                    The sun and the sand makes beaches beautiful
                </h4>

                <hr />

                <a href="#">
                    Read More →
                </a>

            </div>

            {/* Card 2 */}

            <div className="card">

                <img
                    src="/images/blog-2.jpg"
                    alt="blog2"
                />

                <span className="date">
                    15 Dec
                </span>

                <div style={{ display: "flex" }}>

                    <div className="margin-styles1">

                        <img
                            src="/images/person.png"
                            style={{ height: "auto", width: "10px" }}
                            alt="person"
                        />

                        By Admin

                    </div>

                    <div className="margin-styles2">

                        <img
                            src="/images/tag.png"
                            style={{ height: "auto", width: "15px" }}
                            alt="tag"
                        />

                        Donation

                    </div>

                </div>

                <hr />

                <h4>
                    The sun and the sand makes beaches beautiful
                </h4>

                <hr />

                <a href="#">
                    Read More →
                </a>

            </div>

            {/* Card 3 */}

            <div className="card">

                <img
                    src="/images/blog-1.jpg"
                    alt="blog3"
                />

                <span className="date">
                    15 Dec
                </span>

                <div style={{ display: "flex" }}>

                    <div className="margin-styles1">

                        <img
                            src="/images/person.png"
                            style={{ height: "auto", width: "10px" }}
                            alt="person"
                        />

                        By Admin

                    </div>

                    <div className="margin-styles2">

                        <img
                            src="/images/tag.png"
                            style={{ height: "auto", width: "15px" }}
                            alt="tag"
                        />

                        Donation

                    </div>

                </div>

                <hr />

                <h4>
                    The sun and the sand makes beaches beautiful
                </h4>

                <hr />

                <a href="#">
                    Read More →
                </a>

            </div>

            {/* Card 4 */}

            <div className="card">

                <img
                    src="/images/blog-3.jpg"
                    alt="blog4"
                />

                <span className="date">
                    15 Dec
                </span>

                <div style={{ display: "flex" }}>

                    <div className="margin-styles1">

                        <img
                            src="/images/person.png"
                            style={{ height: "auto", width: "10px" }}
                            alt="person"
                        />

                        By Admin

                    </div>

                    <div className="margin-styles2">

                        <img
                            src="/images/tag.png"
                            style={{ height: "auto", width: "15px" }}
                            alt="tag"
                        />

                        Donation

                    </div>

                </div>

                <hr />

                <h4>
                    The sun and the sand makes beaches beautiful
                </h4>

                <hr />

                <a href="#">
                    Read More →
                </a>

            </div>

        </div>

    </div>

</div>
    )
}
export default Blog