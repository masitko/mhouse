import store from '../store';
import guest from './before/guest';
import auth from './before/auth';
import verify2f from './before/verify2f';
import allow from './before/allow';
import progressBar from './before/progressBar';


export default (to, from, next) => {
  progressBar();
  if (store.state.auth.isAuth) {
    verify2f(to, from, next);
    auth(to, from, next);
    allow(to, from, next);
  } else {
    guest(to, from, next);
  }
};