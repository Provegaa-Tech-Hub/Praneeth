

import React from "react";

 
// Store all content in variables
const dashboardData = [
  {
    id: 1,
    title: "Server Request",
    type: "simple",
  },

  {
    id: 2,
    title: "Visitors",
    number: "98,425k",
    percentage: "+2.5%",
    subtitle: "Than last week",
    action: "View More",
    type: "stats",
  },

  {
    id: 3,
    title: "Chart Summary",
    action: "Download Report",
    type: "chart",
  },
];

const DashboardCards = () => {
  return (
    <div className="dashboard-wrapper">

      {dashboardData.map((item) => (

        <div className="dashboard-card" key={item.id}>

          <div className="card-header">
            <h2>{item.title}</h2>

            {item.action && (
              <button className="action-btn">
                {item.action}
              </button>
            )}
          </div>

      
          {item.type === "stats" && (
            <div className="stats-content">

              <h1>{item.number}</h1>

              <div className="stats-text">
                <span>{item.percentage}</span>
                <p>{item.subtitle}</p>
              </div>

            </div>
          )}

     
          {item.type === "chart" && (
            <div className="chart-box">
            
            </div>
          )}

        </div>
      ))}

    </div>
  );
};

export default DashboardCards;