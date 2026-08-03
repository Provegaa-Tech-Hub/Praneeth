// ==========================================
// NOTIFICATIONS.JS
// ==========================================

// Mark all notifications as read

const markReadBtn = document.querySelector(".mark-read");

if (markReadBtn) {

    markReadBtn.addEventListener("click", function () {

        const unreadCards = document.querySelectorAll(".notification-card.unread");

        unreadCards.forEach(function (card) {

            card.classList.remove("unread");

        });

        alert("All notifications marked as read!");

    });

}

// ==========================================
// Notification Click Effect
// ==========================================

const notificationCards = document.querySelectorAll(".notification-card");

notificationCards.forEach(function (card) {

    card.addEventListener("click", function () {

        card.classList.remove("unread");

    });

});

// ==========================================
// Sample Notification Counter
// ==========================================

function updateNotificationCount() {

    const unread = document.querySelectorAll(".notification-card.unread").length;

    document.title = unread > 0
        ? "(" + unread + ") Notifications | Candidate Portal"
        : "Notifications | Candidate Portal";

}

updateNotificationCount();

// Update count whenever a notification is clicked

notificationCards.forEach(function (card) {

    card.addEventListener("click", function () {

        updateNotificationCount();

    });

});

// Update count after "Mark All Read"

if (markReadBtn) {

    markReadBtn.addEventListener("click", function () {

        updateNotificationCount();

    });

}