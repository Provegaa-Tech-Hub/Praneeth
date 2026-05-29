// src/pages/Home.jsx

import React from "react";

import {
  Heart,
  MessageCircle,
  Send,
  Bookmark,
  MoreHorizontal,
  Home,
  Search,
  Compass,
  Film,
  MessageSquare,
  Bell,
  PlusSquare,
  Menu,
} from "lucide-react";

const stories = [
  {
    name: "Your Story",
    image:
      "https://randomuser.me/api/portraits/women/44.jpg",
  },

  {
    name: "Alex",
    image:
      "https://randomuser.me/api/portraits/men/32.jpg",
  },

  {
    name: "Sara",
    image:
      "https://randomuser.me/api/portraits/women/68.jpg",
  },

  {
    name: "David",
    image:
      "https://randomuser.me/api/portraits/men/75.jpg",
  },

  {
    name: "Emma",
    image:
      "https://randomuser.me/api/portraits/women/12.jpg",
  },
];

const posts = [
  {
    username: "praneeth_dev",
    userImage:
      "https://randomuser.me/api/portraits/men/32.jpg",

    postImage:
      "https://images.unsplash.com/photo-1506744038136-46273834b3fb",

    likes: "12,540",

    caption:
      "Beautiful nature vibes 🌍✨",
  },

  {
    username: "sara_ui",
    userImage:
      "https://randomuser.me/api/portraits/women/68.jpg",

    postImage:
      "https://images.unsplash.com/photo-1493246318656-5bfd4cfb29b8",

    likes: "8,240",

    caption:
      "Weekend chill 💜",
  },
];

const HomePage = () => {
  return (

    <div className="instagram-container">

      {/* SIDEBAR */}

      <div className="instagram-sidebar">

        <h1 className="instagram-logo">
          Instagram
        </h1>

        <div className="instagram-menu">

          <div className="menu-item active">
            <Home size={28} />
            <span>Home</span>
          </div>

          <div className="menu-item">
            <Search size={28} />
            <span>Search</span>
          </div>

          <div className="menu-item">
            <Compass size={28} />
            <span>Explore</span>
          </div>

          <div className="menu-item">
            <Film size={28} />
            <span>Reels</span>
          </div>

          <div className="menu-item">
            <MessageSquare size={28} />
            <span>Messages</span>
          </div>

          <div className="menu-item">
            <Bell size={28} />
            <span>Notifications</span>
          </div>

          <div className="menu-item">
            <PlusSquare size={28} />
            <span>Create</span>
          </div>

        </div>

        <div className="bottom-menu">

          <div className="menu-item">
            <Menu size={28} />
            <span>More</span>
          </div>

        </div>

      </div>

      {/* FEED */}

      <div className="instagram-feed">

        {/* STORIES */}

        <div className="stories-section">

          {stories.map((story, index) => (

            <div
              className="story-box"
              key={index}
            >

              <div className="story-ring">

                <img
                  src={story.image}
                  alt=""
                  className="story-image"
                />

              </div>

              <p>{story.name}</p>

            </div>
          ))}
        </div>

        {/* POSTS */}

        {posts.map((post, index) => (

          <div
            className="post-card"
            key={index}
          >

            {/* TOP */}

            <div className="post-top">

              <div className="post-user">

                <img
                  src={post.userImage}
                  alt=""
                />

                <span>
                  {post.username}
                </span>

              </div>

              <MoreHorizontal size={22} />

            </div>

            {/* IMAGE */}

            <img
              src={post.postImage}
              alt=""
              className="post-image"
            />

            {/* ACTIONS */}

            <div className="post-actions">

              <div className="left-actions">

                <Heart size={26} />

                <MessageCircle size={26} />

                <Send size={26} />

              </div>

              <Bookmark size={26} />

            </div>

            {/* CONTENT */}

            <div className="post-content">

              <h4>
                {post.likes} likes
              </h4>

              <p>

                <b>
                  {post.username}
                </b>{" "}

                {post.caption}

              </p>

              <span>
                View all comments
              </span>

            </div>

          </div>
        ))}
      </div>

      {/* RIGHT SIDEBAR */}

      <div className="instagram-rightbar">

        <div className="profile-section">

          <img
            src="https://randomuser.me/api/portraits/men/32.jpg"
            alt=""
          />

          <div>

            <h4>
              suram_praneeth
            </h4>

            <p>
              React Developer
            </p>

          </div>

        </div>

        <div className="suggestions-header">

          <span>
            Suggestions For You
          </span>

          <a href="/">
            See All
          </a>

        </div>

        <div className="suggestion-user">

          <div className="suggestion-left">

            <img
              src="https://randomuser.me/api/portraits/women/22.jpg"
              alt=""
            />

            <div>

              <h5>
                alex_ui
              </h5>

              <p>
                Suggested for you
              </p>

            </div>

          </div>

          <button>
            Follow
          </button>

        </div>

        <div className="suggestion-user">

          <div className="suggestion-left">

            <img
              src="https://randomuser.me/api/portraits/men/65.jpg"
              alt=""
            />

            <div>

              <h5>
                david_dev
              </h5>

              <p>
                New to Instagram
              </p>

            </div>

          </div>

          <button>
            Follow
          </button>

        </div>

      </div>

    </div>
  );
};

export default HomePage;