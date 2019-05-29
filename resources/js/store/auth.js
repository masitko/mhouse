export const state = {
  isAuth: localStorage.getItem('isAuth') === 'true',
  isAuth1st: localStorage.getItem('isAuth1st') === 'true',
  isAuth2nd: localStorage.getItem('isAuth2nd') === 'true',
};

export const mutations = {
  login(state) {
    console.log('SETTING AUTH TO TRUE !!! ');
    console.log(state);
    state.isAuth = true;
    localStorage.setItem('isAuth', true);
  },
  auth1f(state) {
    console.log('SETTING 1st AUTH FACTOR !!! ');
    state.isAuth1st = true;
    localStorage.setItem('isAuth1st', true);
  },
  auth2f(state) {
    console.log('SETTING 2nd AUTH FACTOR !!! ');
    state.isAuth2nd = true;
    localStorage.setItem('isAuth2nd', true);
  },
  logout(state) {
    state.isAuth = false;
    state.isAuth1st = false;
    state.isAuth2nd = false;
    localStorage.setItem('isAuth', false);
    localStorage.setItem('isAuth1st', false);
    localStorage.setItem('isAuth2nd', false);
  },
};