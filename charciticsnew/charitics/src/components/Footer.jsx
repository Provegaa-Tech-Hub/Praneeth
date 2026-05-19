
function Footer(){
    return(
<div className="footer-hero">

    <div className="footer-container">

        <div className="footer-middle">

            {/* Logo Section */}

            <div className="margin-main">

                <img
                    src="/images/logo-white.svg"
                    alt="logo"
                    className="logo-styles"
                />

                <div className="margin-styles">
                    Phasellus ultricies aliquam volutpat ullamcorper
                    laoreet neque, a lacinia curabitur lacinia mollis
                </div>

                <div className="social-icons">

                    <div className="social-icon-styles">
                        <i className="fab fa-facebook-f"></i>
                    </div>

                    <div className="social-icon-styles">
                        <i className="fab fa-twitter"></i>
                    </div>

                    <div className="social-icon-styles">
                        <i className="fab fa-linkedin-in"></i>
                    </div>

                    <div className="social-icon-styles">
                        <i className="fab fa-youtube"></i>
                    </div>

                </div>

            </div>

            {/* Quick Links */}

            <div className="links-main">

                <div className="links-text">
                    Quick Links
                </div>

                <div className="links-styles">

                    <div className="margin-styles3">

                        <img
                            src="/images/double-arrow.png"
                            className="arrow-styles1"
                            alt="arrow"
                        />

                        About Us

                    </div>

                    <div className="margin-styles3">

                        <img
                            src="/images/double-arrow.png"
                            className="arrow-styles2"
                            alt="arrow"
                        />

                        Our Services

                    </div>

                    <div className="margin-styles3">

                        <img
                            src="/images/double-arrow.png"
                            className="arrow-styles2"
                            alt="arrow"
                        />

                        Our Blogs

                    </div>

                    <div className="margin-styles3">

                        <img
                            src="/images/double-arrow.png"
                            className="arrow-styles2"
                            alt="arrow"
                        />

                        FAQ’S

                    </div>

                    <div className="margin-styles3">

                        <img
                            src="/images/double-arrow.png"
                            className="arrow-styles2"
                            alt="arrow"
                        />

                        Contact Us

                    </div>

                </div>

            </div>

            {/* Recent Posts */}

            <div className="post-hero">

                <div className="post-main">
                    Recent Posts
                </div>

                <div className="blog-main">

                    <div>

                        <img
                            src="/images/blog-2.jpg"
                            alt="blog"
                            className="blog-img"
                        />

                    </div>

                    <div className="footer-date">

                        <i
                            className="fa-solid fa-calendar-days"
                            style={{ color: "white" }}
                        ></i>

                        May 12, 2025

                        <div className="footer-text">
                            There are many vario ns of passages of
                        </div>

                    </div>

                </div>

                <div className="blog-main">

                    <div>

                        <img
                            src="/images/blog-1.jpg"
                            alt="blog"
                            className="blog-img"
                        />

                    </div>

                    <div className="footer-date">

                        <i
                            className="fa-solid fa-calendar-days"
                            style={{ color: "white" }}
                        ></i>

                        May 12, 2025

                        <div className="footer-text">
                            There are many vario ns of passages of
                        </div>

                    </div>

                </div>

            </div>

            {/* Contact Section */}

            <div className="contact-hero">

                <div className="contact-main">
                    Contact Us
                </div>

                <div className="contact-text">

                    <div className="mail-info">

                        <i className="fa-solid fa-envelope"></i>

                        info@example.com

                    </div>

                </div>

                <div className="phone-info">

                    <i className="fa-solid fa-phone-volume"></i>

                    123-456-7890

                </div>

                <form className="mail-main">

                    <div className="mail-styles">

                        <input
                            type="text"
                            id="email"
                            placeholder="Your Email Address"
                            className="mail-input"
                        />

                        <button
                            type="submit"
                            className="button-btn"
                        >

                            <i className="fa-solid fa-arrow-right"></i>

                        </button>

                    </div>

                    <div className="agreement">

                        <label className="checkbox-text">

                            <input
                                type="checkbox"
                                name="agreement"
                            />

                            <div className="checkbox-text">

                                I agree with the

                                <a
                                    href="#"
                                    style={{ color: "white" }}
                                >
                                    {" "}Privacy Policy
                                </a>

                            </div>

                        </label>

                    </div>

                </form>

            </div>

        </div>

    </div>

    {/* Footer End */}

    <div className="footer-end">

        <div className="reserved">
            © 2026 Charitics. All rights reserved
        </div>

        <div className="terms-conditions">

            <div>
                Terms & Conditions
            </div>

            <div>
                Privacy Policy
            </div>

        </div>

    </div>

</div>
    )
}

export default Footer