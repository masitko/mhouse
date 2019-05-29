export default (to, from, next) => {
    if (to.meta.guestGuard) {
      console.log( 'AUTH - going home');
      next({ name: '/' });
    } else {
      console.log( 'AUTH - just next');
        next();
    }
};
