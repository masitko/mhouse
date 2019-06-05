import store from "../../store";

export default (to, from, next) => {

  // console.log('VERIFYING 2F ... ');

  if (store.state.auth.isAuth1st) {
    if (to.name === 'auth.code') {
      next();
    } else {
      next({
        name: 'auth.code'
      });
    }
  } else {
    if (to.name === 'login') {
      next();
    } else {
      next({
        name: 'login'
      });
    }
  }
};