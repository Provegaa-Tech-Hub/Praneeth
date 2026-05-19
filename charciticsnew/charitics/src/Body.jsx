
function Body(){
    return(
<div>
    <div className="upcoming-container">

        <div style={{ marginLeft: "35px" }}>

            <div className="upcoming-text">
                ❤️ Our Team
            </div>

            <div className="skilled-text">
                Skilled Legal Professionals Dedicated to You
            </div>

        </div>

        <div className="buttons">

            <button className="explore">

                <img
                    src="/images/double-arrow.png"
                    alt="arrow"
                />

                Join With us

            </button>

        </div>

    </div>

    <div className="card-main">

        {/* Card 1 */}

        <div className="card">

            <img
                src="/images/member-1.jpg"
                alt="member1"
            />

            <div className="overlay">

                <div className="social">

                    <i className="fab fa-facebook-f"></i>
                    <i className="fab fa-twitter"></i>
                    <i className="fab fa-linkedin-in"></i>
                    <i className="fab fa-instagram"></i>

                </div>

            </div>

            <div className="card-content">

                <h3>John Doe</h3>

                <p>Attorney</p>

            </div>

        </div>

        {/* Card 2 */}

        <div className="card">

            <img
                src="/images/member-2.jpg"
                alt="member2"
            />

            <div className="overlay">

                <div className="social">

                    <i className="fab fa-facebook-f"></i>
                    <i className="fab fa-twitter"></i>
                    <i className="fab fa-linkedin-in"></i>
                    <i className="fab fa-instagram"></i>

                </div>

            </div>

            <div className="card-content">

                <h3>John Doe</h3>

                <p>Attorney</p>

            </div>

        </div>

        {/* Card 3 */}

        <div className="card">

            <img
                src="/images/member-3.jpg"
                alt="member3"
            />

            <div className="overlay">

                <div className="social">

                    <i className="fab fa-facebook-f"></i>
                    <i className="fab fa-twitter"></i>
                    <i className="fab fa-linkedin-in"></i>
                    <i className="fab fa-instagram"></i>

                </div>

            </div>

            <div className="card-content">

                <h3>John Doe</h3>

                <p>Attorney</p>

            </div>

        </div>

        {/* Card 4 */}

        <div className="card">

            <img
                src="/images/member-4.jpg"
                alt="member4"
            />

            <div className="overlay">

                <div className="social">

                    <i className="fab fa-facebook-f"></i>
                    <i className="fab fa-twitter"></i>
                    <i className="fab fa-linkedin-in"></i>
                    <i className="fab fa-instagram"></i>

                </div>

            </div>

            <div className="card-content">

                <h3>John Doe</h3>

                <p>Attorney</p>

            </div>

        </div>

    </div>
</div>
    )
}
export default Body