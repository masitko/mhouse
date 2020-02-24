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
    let authRoutes = ['login', 'auth.code', 'password.email', 'password.reset']
    if ( authRoutes.indexOf( to.name ) > -1 ) {
      next();
    } else {
      next({
        name: 'login'
      });
    }
  }
};