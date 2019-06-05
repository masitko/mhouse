export const state = {
  isAuth: localStorage.getItem('isAuth') === 'true',
  isAuth1st: localStorage.getItem('isAuth1st') === 'true',
};

export const mutations = {
  login(state) {
    // console.log('SETTING AUTH TO TRUE !!! ');
    state.isAuth = true;
    localStorage.setItem('isAuth', true);
  },
  auth1f(state) {
    // console.log('SETTING 1st AUTH FACTOR !!! ');
    state.isAuth1st = true;
    localStorage.setItem('isAuth1st', true);
  },
  logout(state) {
    state.isAuth = false;
    state.isAuth1st = false;
    localStorage.setItem('isAuth', false);
    localStorage.setItem('isAuth1st', false);
  },
};