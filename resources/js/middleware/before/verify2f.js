import store from "../store";

export default (to, from, next) => {
  
  if (store.state.auth.isAuth1st) {
    // if (to.meta.guestGuard) {
        next({ name: 'auth.code' });
    } else {
      console.log(to);
      console.log(from);
        next();
    }
};
