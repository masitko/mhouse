export default (to, from, next) => {
    // if (to.meta.guestGuard) {
    //     next({ name: '/' });
    // } else {
      console.log(to);
      console.log(from);
        next();
    // }
};
