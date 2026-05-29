import React from "react";

const stories = [
  {
    name: "Alex",
    image:
      "https://randomuser.me/api/portraits/men/11.jpg",
  },

  {
    name: "Sara",
    image:
      "https://randomuser.me/api/portraits/women/12.jpg",
  },

  {
    name: "John",
    image:
      "https://randomuser.me/api/portraits/men/15.jpg",
  },

  {
    name: "David",
    image:
      "https://randomuser.me/api/portraits/men/18.jpg",
  },

  {
    name: "Emma",
    image:
      "https://randomuser.me/api/portraits/women/19.jpg",
  },
];

const Stories = () => {
  return (

    <div className="stories">

      {stories.map((story, index) => (

        <div
          className="story-wrapper"
          key={index}
        >

          <div className="story-border">

            <img
              src={story.image}
              alt={story.name}
              className="story-image"
            />

          </div>

          <p>{story.name}</p>

        </div>
      ))}

    </div>
  );
};

export default Stories;
