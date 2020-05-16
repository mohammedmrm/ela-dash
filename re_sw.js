window.addEventListener('load', () => {
    registerSW();
  });
  window.addEventListener('beforeinstallprompt', (e) => {
      // prevent chrome 67 and earlier from automatically showing the prompt.
      e.preventDefault();
      deferredPrompt=e;
      //update ui notify the user they can
      // add to home screen
  //    btnAdd.style.display='block'
  });
  
  //btnAdd.addEventListener('click', (e) => {
  //  // hide our user interface that shows our A2HS button
  //  btnAdd.style.display = 'none';
  //  // Show the prompt
  //  deferredPrompt.prompt();
  //  // Wait for the user to respond to the prompt
  //  deferredPrompt.userChoice
  //    .then((choiceResult) => {
  //      if (choiceResult.outcome === 'accepted') {
  //        console.log('User accepted the alnahr client prompt');
  //      } else {
  //        console.log('User dismissed the alnahr client prompt');
  //      }
  //      deferredPrompt = null;
  //    });
  //});
  window.addEventListener('appinstalled', (evt)=>{
     app.logEvent('alnahr clinet','installed'); 
  });
  async function registerSW() {
  if ("serviceWorker" in navigator) {
      navigator.serviceWorker.register("/albarq-pwa/sw.js")    .then(function(registration) {
          console.log("Service Worker registered with scope:", registration.scope);   
      }).catch(function(err) {     
          console.log("Service worker registration failed:", err);   
      });
  }
  }