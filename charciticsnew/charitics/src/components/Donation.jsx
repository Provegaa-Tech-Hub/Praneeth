
function Donation(){
    return(
<div className="donation">

    <div className="donation-box">

        <div className="donation-left donation-img">

            <h3>
                Custome Donate Now
            </h3>

            <div className="amounts">

                <button>$10</button>
                <button>$20</button>
                <button>$30</button>
                <button>$40</button>
                <button>$50</button>

            </div>

            <div className="input-area">

                <input
                    type="text"
                    value="10"
                    readOnly
                />

                <button className="donate-btn">
                    ➤ Donate Now
                </button>

            </div>

        </div>

        <div className="donation-right">

            <p className="tag1">
                ❤️ Donate Now
            </p>

            <div className="donation-text">
                Support Kids by Raising Valuable Donations
            </div>

            <div className="progress">

                <div className="progress-bar">
                    <span></span>
                </div>

                <div className="progress-text">

                    <div>
                        Raised: $25,000
                    </div>

                    <div>
                        Goal: $50,000
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
    )
}

export default Donation