import './bootstrap';

/* inactivity refresh */
let time = new Date().getTime();
const setActivityTime = (e) => {
  

  if (new Date().getTime() - time >= 1800000) { // 30min
    document.body.removeEventListener("click", setActivityTime);
    window.removeEventListener("focus", setActivityTime);
    window.removeEventListener("blur", setActivityTime);
    window.location.reload(true);
    
  }  else {
    time = new Date().getTime();
  }
}
document.body.addEventListener("click", setActivityTime);
window.addEventListener("focus", setActivityTime);
window.addEventListener("blur", setActivityTime);