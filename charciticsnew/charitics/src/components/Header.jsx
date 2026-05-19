function Header() {
    return (
        <header
            className="navbar"
            id="navbar"
        >

            <div className="logo">

                <img
                    src="/images/logo-white.svg"
                    alt="logo"
                />

            </div>

            <nav style={{ marginLeft: "142px" }}>

                <a href="#">Home</a>

                <a href="#">About</a>

                <a href="#">Pages</a>

                <a href="#">Donation</a>

                <a href="#">Event</a>

                <a href="#">Blog</a>

                <a href="#">Contact</a>

            </nav>

            <img
                src="/images/search.png"
                className="search-styles"
                alt="search"
            />

            <button className="join-btn">
                Join With us
            </button>

        </header>
    )
}

export default Header