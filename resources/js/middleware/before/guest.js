export default (to, from, next) => {
  console.log('GUEST GUARD!!');
  if (to.meta.guestGuard) {
    console.log('GUEST - NEXT !!');
    next();
  } else {
    console.log('GUEST - LOGIN!!');
    next({
      name: 'login'
    });
    // next();
  }
};