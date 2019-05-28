export default (to, from, next) => {
  console.log('GUEST GUARD!!');
  if (to.meta.guestGuard) {
        next();
    } else {
      console.log('GUEST - LOGIN!!');
      next({ name: 'login' });
        // next();
      }
};
