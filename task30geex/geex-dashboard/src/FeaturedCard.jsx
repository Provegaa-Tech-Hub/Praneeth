import React from "react";

export const featureData = [
  {
    id: 1,
    subtitle: "Memory",
    title: "200TB",
    badge: "+2.5%",
    image: "/images/feature-2.svg",
  },
  {
    id: 2,
    subtitle: "Visitors",
    title: "87,245k",
    badge: "-4.4%",
    badgeColor: "#FF0000",
    image: "/images/feature-3.svg",
  },
  {
    id: 3,
    subtitle: "New Users",
    title: "4,750",
    badge: " +2.5%",
    image: "/images/feature-1.svg",
  },

];
const widgetData = [
  {
    id: 1,
    title: "Server Status",
    subtitle: "Consectetur et quo dolor vero.",

  },
  {
    id: 2,
    title: "Recent Problems",
    subtitle: "Maiores dicta atque dolorem temporibus",
    marginTop: "65px"
  },
 

];
const websiteData = [
  {
    id: 1,
    icon: "./images/google.svg",
    name: "Google",
    url: "https://www.google.com",
    status: "Down",
    statusClass: "down",
  },
  {
    id: 2,
    icon: "./images/facebook.svg",
    name: "Facebook",
    url: "https://www.facebook.com",
    status: "Stable",
    statusClass: "stable",
    marginTop: "0",
  },
  {
    id: 3,
    icon: "./images/youtube.svg",
    name: "Youtube",
    url: "https://www.youtube.com",
    status: "Warning",
    statusClass: "warning",
    marginTop: "0",
  }
]


const activityData = [
  {
    id: 1,
    date: "January 2nd, 04:35 AM",
    description:
      "Illum omnis quo illum nisi. Nesciunt est accusamus. Blanditiis nisi quae eum nisi similique.",
  },
  {
    id: 2,
    date: "January 4th, 06:19 AM",
    description:
      "Corrupti unde qui molestiae labore ad adipisci veniam perspiciatis quasi. Quae labore vel.",
  },
  {
    id: 3,
    date: "January 5th, 12:34 AM",
    description:
      "Maiores doloribus qui. Repellat accusamus minima ipsa ipsam aut debitis quis sit voluptates. Amet necessitatibus non minus quaerat et quis.",
  },
];


const FeatureCard = () => {
  return (
    <>
      <div className="feature-container">
        {featureData.map((item) => (
          <div className="geex-content__feature__card" key={item.id}>
            <div>
              <p className="geex-content__feature__card__subtitle">
                {item.subtitle}
              </p>

              <h4 className="geex-content__feature__card__title">
                {item.title}
              </h4>

              <span
                className="geex-content__feature__card__badge"
                style={{
                  color: item.badgeColor,
                  backgroundColor: item.badgeBg,
                }}
              >
                {item.badge}
              </span>
            </div>

            <div className="geex-content__feature__card__img">
              <img src={item.image} alt={item.subtitle} />
            </div>
          </div>


        ))}
        <div>
          {
            widgetData.map((item) =>
              <div className="geex-content__widget__single__header" key={item.id}
                style={{ marginTop: item.marginTop }}>

                <h4 className="geex-content__widget__single__title" >
                  {item.title}
                </h4>

                <p className="geex-content__widget__single__subtitle" >
                  {item.subtitle}
                </p>

              </div>
            )}
        </div>
        <div className="website-list">
          {websiteData.map((site) => (
            <div className="website-item" key={site.id} style={{ marginTop: site.marginTop }}>
              <div className="website-info">
                <div className="website-icon">
                  <img src={site.icon} alt={site.name} />
                </div>

                <div className="website-content">
                  <h4>{site.name}</h4>
                  <p>{site.url}</p>
                </div>
              </div>

              <button className={`status-btn ${site.statusClass}`}>
                {site.status}
              </button>
            </div>
          ))}
        </div>

         <div className="activity-card">
      <h2 className="activity-title">
        Latest Activity
      </h2>

      <p className="activity-subtitle">
        Sit et tempora dicta omnis ab quia quo quo.
      </p>

      {activityData.map((item) => (
        <div className="timeline-item" key={item.id}>
          <div className="timeline-dot"></div>

          <div className="timeline-content">
            <h4>{item.date}</h4>
            <p>{item.description}</p>
          </div>
        </div>
      ))}
    </div>
      </div>
    </>

  );
};
export default FeatureCard;