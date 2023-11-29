importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyBPUu2gtAXh0PMJxU_d7LqzyP8zqz5WwvQ",
    authDomain: "uniquedispatch-b5f9c.firebaseapp.com",
    projectId: "uniquedispatch-b5f9c",
    storageBucket: "uniquedispatch-b5f9c.appspot.com",
    messagingSenderId: "199811555603",
    appId: "1:199811555603:web:dde058c0067b1e9c1afae6",
    measurementId: "G-2WKBMT7CB7"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});
