
function Volunteer(){
    return(
<section className="volunteer">

    <div className="left-img">

        <div className="img-box">

            <img
                src="/images/why-join.jpg"
                alt="people"
            />

        </div>

    </div>

    <div className="content">

        <span className="tag">
            ❤ Join us
        </span>

        <h2>
            Why We Need You Become a Volunteer
        </h2>

        <p className="desc">
            We help companies develop powerful corporate social responsibility,
            grantmaking, and employee engagement strategies.
        </p>

        <div
            className="acc-item"
            style={{ marginBottom: "10px" }}
        >

            Recognition and Fulfillment

            <i className="fas fa-arrow-right"></i>

        </div>

        <div className="accordion">

            <div className="acc-item">

                Why Join Us as a Volunteer?

                <i className="fas fa-arrow-right"></i>

            </div>

            <div className="acc-item">

                Be Part of a Community

                <i className="fas fa-arrow-right"></i>

            </div>

        </div>

    </div>

</section>
    )
}

export default Volunteer